$(function() {
    var uniqueId = 0;

    function ajaxYqlWithJson(options) {
        var callbackName = 'my_yql_callback_' + ++uniqueId;
        window[callbackName] = options.callback;

        var yql = 'SELECT * FROM json WHERE url="' + encodeURIComponent(options.url) + '"';

        $.ajax({
            url: 'http://query.yahooapis.com/v1/public/yql?q=' + yql +
                '&format=json&callback=' + callbackName,
            dataType: 'script',
            complete: function() {
                delete window[callbackName];
            }
        });
    }

    function createSelectCallback(index) {
        return function(data) {
            var select = $('select').eq(index);
            $(data.query.results.result.subRegion).each(function(i, region) {
                $('<option></option>').attr('value', region.code).text(region.name)
                    .appendTo(select);
            });
        };
    }

    function clearSelect(select) {
        select.html(select.children().first());
    }

    function ajaxGetRegions(options) {
        var level = options.level;
        var code = options.code;
        if (code && level <= 8) {
            ajaxYqlWithJson({
                url: 'http://map.naver.com/common2/getBRegionByCodeAndLevel.nhn' +
                    '?level=' + level + '&code=' + code,
                callback: options.callback
            });
        }
    }

    $('select').each(function(index, select) {
        $(select).change(function() {
            for (var i = index + 1; i < $('select').length; i++) {
                clearSelect($('select').eq(i));
            }
            ajaxGetRegions({
                level: 2 + 3 * (index + 1),
                code: $(this).val(),
                callback: createSelectCallback(index + 1)
            })
        });
    });

    ajaxYqlWithJson({
        url: 'http://map.naver.com/common2/getBRegionByCodeAndLevel.nhn?level=2',
        callback: createSelectCallback(0)
    });
});