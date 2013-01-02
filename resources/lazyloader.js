/*
 * Lazy Loader 0.9.2 - jQuery plugin for lazy loading images
 *
 * Copyright(c) 2006-2011 Xenophy.CO.,LTD All rights Reserved.
 * http://www.xenophy.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */
(function($) {

    $.fn.lazyloader = function(opt) {

        var conf = {
            threshold    : 0,
            failurelimit : 1000,
            event        : "scroll",
            effect       : "show",
            imgSrcAttr   : "original",
            container    : window,
            beforeLoadCls: 'loading'
        },that = this;

        if (opt) {
            $.extend(conf, opt);
        }

        if ("scroll" == conf.event) {
            $(conf.container).bind("scroll", function(e) {

                var counter = 0,
                    tmp;
                that.each(function() {
                    var me = this;
                    if (
                        $.abovethetop(me, conf) ||
                        $.leftofbegin(me, conf)
                    ) {
                        // ä½•ã‚‚ã—ãªã„
                    } else if (
                        !$.belowthefold(me, conf) &&
                        !$.rightoffold(me, conf)
                    ) {
                            $(me).trigger("appear");
                    } else {
                        if (counter++ > conf.failurelimit) {
                            return false;
                        }
                    }
                });

                tmp = $.grep(that, function(el) {
                    return !el.loaded;
                });
                that = $(tmp);
            });
        }

        that.each(function() {
            var me = this;
            $(me).addClass(conf.beforeLoadCls);

            if (undefined == $(me).attr(conf.imgSrcAttr)) {
                $(me).attr(conf.imgSrcAttr, $(me).attr("src"));
            }

            if (
                "scroll" != conf.event ||
                undefined == $(me).attr("src") ||
                (
                     $.abovethetop(me, conf) ||
                     $.leftofbegin(me, conf) ||
                     $.belowthefold(me, conf) ||
                     $.rightoffold(me, conf)
                )
            ) {
                me.loaded = false;
            } else {
                me.loaded = true;
            }

            $(me).one("appear", function() {
                $("<img />")
                    .bind("load", function() {
                        $(me).hide()
                               .removeClass(conf.beforeLoadCls)
                               .attr("src", $(me).attr(conf.imgSrcAttr))
                                [conf.effect](conf.effectspeed);
                        me.loaded = true;
                    })
                    .attr("src", $(me).attr(conf.imgSrcAttr))
                    .attr(conf.imgSrcAttr, '');

            });

            if ("scroll" != conf.event) {
                $(me).bind(conf.event, function(e) {
                    if (!me.loaded) {
                        $(me).trigger("appear");
                    }
                });
            }
        });

        $(conf.container).trigger(conf.event);

        return this;

    };

    $.belowthefold = function(el, conf) {
        var fold;
        if (conf.container === undefined || conf.container === window) {
            fold = $(window).height() + $(window).scrollTop();
        } else {
            fold = $(conf.container).offset().top + $(conf.container).height();
        }
        return fold <= $(el).offset().top - conf.threshold;
    };

    $.rightoffold = function(el, conf) {
        var fold;
        if (conf.container === undefined || conf.container === window) {
            fold = $(window).width() + $(window).scrollLeft();
        } else {
            fold = $(conf.container).offset().left + $(conf.container).width();
        }
        return fold <= $(el).offset().left - conf.threshold;
    };

    $.abovethetop = function(el, conf) {
        var fold;
        if (conf.container === undefined || conf.container === window) {
            fold = $(window).scrollTop();
        } else {
            fold = $(conf.container).offset().top;
        }
        return fold >= $(el).offset().top + conf.threshold  + $(el).height();
    };

    $.leftofbegin = function(el, conf) {
        var fold;
        if (conf.container === undefined || conf.container === window) {
            fold = $(window).scrollLeft();
        } else {
            fold = $(conf.container).offset().left;
        }
        return fold >= $(el).offset().left + conf.threshold + $(el).width();
    };

    $.extend($.expr[':'], {
        "below-the-fold" : "$.belowthefold(a, {threshold : 0, container: window})",
        "above-the-fold" : "!$.belowthefold(a, {threshold : 0, container: window})",
        "right-of-fold"  : "$.rightoffold(a, {threshold : 0, container: window})",
        "left-of-fold"   : "!$.rightoffold(a, {threshold : 0, container: window})"
    });

})(jQuery);


