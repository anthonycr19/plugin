(function($, window, document, undefined) {
    'use strict';

    // init cubeportfolio
    $('#js-grid-meet-the-team').cubeportfolio({
		defaultFilter: '*',
        filters: '#js-filters-meet-the-team',
        layoutMode: 'grid',       
        animationType: 'sequentially',
        gapHorizontal: 50,
        gapVertical: 40,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 1500,
            cols: 5
        }, {
            width: 1100,
            cols: 4
        }, {
            width: 800,
            cols: 3
        }, {
            width: 480,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        caption: 'fadeIn',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,

        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageCallback: function(url, element) {
            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var t = this;

            $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    timeout: 10000
                })
                .done(function(result) {
                    t.updateSinglePage(result);
                })
                .fail(function() {
                    t.updateSinglePage('AJAX Error! Please refresh the page!');
                });
        },
    });
})(jQuery, window, document);