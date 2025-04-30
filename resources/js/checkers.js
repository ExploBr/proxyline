function splitArray(array, n) {
    var i,
        j,
        arrays = [];

    for (i = 0, j = array.length; i < j; i += n) {
        arrays.push(array.slice(i, i + n));
    }

    return arrays;
}

function validateProxies(proxies) {
    var proxy, i;

    for (i = 0; i < proxies.length; i++) {
        proxy = proxies[i].split(":");

        if (proxy.length !== 2 && proxy.length !== 4) {
            proxies.splice(i, 1);
        }
    }

    return proxies;
}

function incrValidNum(n) {
    $(".js-valid-num").text(n);
}

function incrInvalidNum(n) {
    $(".js-invalid-num").text(n);
}

function flashSupport() {
    var hasFlash = false;

    try {
        hasFlash = Boolean(new ActiveXObject("ShockwaveFlash.ShockwaveFlash"));
    } catch (exception) {
        hasFlash =
            "undefined" !=
            typeof navigator.mimeTypes["application/x-shockwave-flash"];
    }

    return hasFlash;
}

function getIPData(callback) {
    $.ajax({
        url: "https://api.proxy-checker.net/api/ip-data/",

        success: function (data) {
            callback(data);

            // console.log(data);
        },
    });
}

function getIPBData(callback) {
    $.ajax({
        url: "https://api.proxy-checker.net/api/request-data/",

        success: function (data) {
            callback(data);

            //console.log(data);
        },
    });
}

var SpeedTest = {
    ping: function (callback) {
        var start = new Date();

        $.ajax({
            url: "https://api.proxy-checker.net/api/upload-test/",

            cache: false,

            complete: function () {
                callback(new Date().getTime() - start.getTime());
            },
        });
    },

    upload: function (callback) {
        var start = new Date();

        var data = "1".repeat(1024 * 1024);

        $.ajax({
            url: "https://api.proxy-checker.net/api/upload-test/",

            cache: false,

            type: "POST",

            data: {
                d: data,
            },

            success: function () {
                var elapsed = (new Date().getTime() - start.getTime()) / 1000;

                callback(
                    ((data.length / 1024 / 1024 / elapsed) * 8).toFixed(2)
                );
            },
        });
    },

    download: function (callback) {
        var start = new Date();

        $.ajax({
            url: "https://api.proxy-checker.net/api/download-test/",

            cache: false,

            success: function (data) {
                var elapsed = (new Date().getTime() - start.getTime()) / 1000;

                callback(
                    ((data.length / 1024 / 1024 / elapsed) * 8).toFixed(2)
                );
            },
        });
    },
};

var ALERT_DANGER = '<div class="pravicy pravicy-red">{text}</div>';

var ALERT_SUCCESS = '<div class="pravicy pravicy-green">{text}</div>';

function errorsToAlerts(errors) {
    if (typeof errors === "string") {
        errors = JSON.parse(errors);
    }

    var alerts = [];

    for (var field in errors) {
        if (errors.hasOwnProperty(field)) {
            var fieldErrors = errors[field];

            for (var i = 0; i < fieldErrors.length; i++) {
                var text = fieldErrors[i]["message"];

                var alert = ALERT_DANGER;

                alert = alert.replace("{text}", text);

                alerts.push(alert);
            }
        }
    }

    return alerts;
}

function getPrivacyPercent() {
    var checks = [
        [$(".js-has-proxy-yes:visible").length > 0, 10],

        [$(".js-flash-support-yes:visible").length > 0, 10],

        [$(".js-java-support-yes:visible").length > 0, 10],

        [$(".js-activex-support-yes:visible").length > 0, 10],

        [$(".js-webrtc-support-yes:visible").length > 0, 10],

        [$(".js-open-ports-yes:visible").length > 0, 10],

        [parseInt($(".js-privacy-blacklist div").text()) > 0, 10],
    ];

    var percent = 100,
        i;

    for (i = 0; i < checks.length; i++) {
        if (checks[i][0]) {
            percent = percent - checks[i][1];
        }
    }

    return percent;
}

$(function () {
    var CHECK_CHUNK_SIZE = 20;

    var PAGE_LENGTH = 100;

    var EMPTY_VALUE = "—";

    var CHECKED_PROXIES = [];

    var CONCURRENT_REQUESTS = 10;

    var TRANSLATIONS = {
        anonymity_levels: {
            0: "Прозрачные",

            1: "Анонимные",

            2: "Высоко-анонимные",
        },
    };

    if ($(".js-load-ip-data").length !== 0) {
        getIPData(function (data) {
            var date = new Date(),
                i;

            var time_options = {
                day: "2-digit",

                month: "2-digit",

                year: "numeric",

                hour: "2-digit",

                minute: "2-digit",
            };

            var datetime = date.toLocaleString([], time_options);

            time_options.timeZone = data.timezone;

            var ipdatetime = date.toLocaleString([], time_options);

            jQuery
                .get("https://panel.proxyline.net/countries/")
                .done(function (datapanel) {
                    var thisdata = Array.from(datapanel);
                    var thiscountry = data.country;
                    datapanel.forEach((el) => {
                        if (document.documentElement.lang != "ru-RU") {
                            if (el["code"] == data.countryCode.toLowerCase()) {
                                thiscountry = el["name"];
                            }
                        }
                    });
                    $(".js-country").text(thiscountry || EMPTY_VALUE);
                });

            $(".js-ip").text(data.query || EMPTY_VALUE);

            $(".js-city").text(data.city || EMPTY_VALUE);

            $(".js-zip").text(data.zip || EMPTY_VALUE);

            $(".js-isp").text(data.isp || EMPTY_VALUE);

            $(".js-location span").text([data.lat, data.lon].join(", "));

            $(".js-map").data("lat", data.lat).data("long", data.lon);

            $(".js-map img")
                .attr(
                    "src",
                    "https://static-maps.yandex.ru/1.x/?ll=" +
                        data.lon +
                        "," +
                        data.lat +
                        "&size=335,215&z=13&l=map&pt=" +
                        data.lon +
                        "," +
                        data.lat
                )
                .show();

            $(".js-timezone").text(data.timezone || EMPTY_VALUE);

            $(".js-time-timezone").text(
                ipdatetime + " " + data.timezone || EMPTY_VALUE
            );

            // $('.js-local-time').text(time);

            $(".js-local-time").text(datetime);

            // $('.js-ip-time').text(formatter.format(new Date()));

            $(".js-ip-time").text(ipdatetime);

            if (data.proxy) {
                $(".js-has-proxy-yes").show();
            } else {
                $(".js-has-proxy-no").show();
            }
        });

        getIPBData(function (data) {
            $(".js-x_forwarded_for").text(data.x_forwarded_for || EMPTY_VALUE);

            $(".js-connection").text(data.connection || EMPTY_VALUE);

            $(".js-x_forwarded_proto").text(
                data.x_forwarded_proto || EMPTY_VALUE
            );

            $(".js-referer").text(
                data.referer ||
                    location.origin + location.pathname ||
                    EMPTY_VALUE
            );

            $(".js-user_agent").text(data.user_agent || EMPTY_VALUE);

            $(".js-accept").text(data.accept || EMPTY_VALUE);

            $(".js-accept_encoding").text(data.accept_encoding || EMPTY_VALUE);

            $(".js-accept_language").text(data.accept_language || EMPTY_VALUE);

            $(".js-accept_charset").text(data.accept_charset || EMPTY_VALUE);

            $(".js-cookie").text(data.cookie || EMPTY_VALUE);

            $(".js-os-family").text(data.os_info.family || EMPTY_VALUE);

            $(".js-browser_info").text(
                data.browser_info.family +
                    ", " +
                    data.browser_info.major +
                    "." +
                    data.browser_info.minor +
                    "." +
                    data.browser_info.patch || EMPTY_VALUE
            );

            if (navigator.userAgent === $(".js-user_agent").text()) {
                $(".js-user-agent-label")
                    .addClass("yellow-label")
                    .show()
                    .text("Yes");
            } else {
                $(".js-user-agent-label")
                    .addClass("red-label")
                    .show()
                    .text("No");
            }
        });
    }

    if ($(".js-privacy-check-ports").length !== 0) {
        $.ajax({
            url: "https://api.proxy-checker.net/api/privacy-check-ports/",

            method: "POST",

            success: function (data) {
                if (data.result) {
                    $(".js-open-ports-yes").show();
                } else {
                    $(".js-open-ports-no").show();
                }
            },
        });
    }

    $(".check-port .js-port-list a").click(function (event) {
        event.preventDefault();
        jQuery(".js-port").val(jQuery(this).attr("data-port"));
    });

    if ($(".js-privacy-check-blacklists").length !== 0) {
        var privacyRequests = [];

        var ip = $(".js-ip").val().trim();

        $(".blist").each(function (index) {
            var el = $(this);

            privacyRequests.push(
                $.ajax({
                    url: "https://api.proxy-checker.net/api/blacklist-check/",

                    method: "POST",

                    data: { ip: ip, blacklist: el.data("list") },

                    success: function (data) {
                        $(".js-privacy-blacklist span").text(
                            parseInt($(".js-privacy-blacklist span").text()) + 1
                        );

                        if (data.result) {
                            $(".js-privacy-blacklist div").text(
                                parseInt(
                                    $(".js-privacy-blacklist div").text()
                                ) + 1
                            );
                        }
                    },

                    error: function (res) {
                        console.log(res);
                    },
                })
            );
        });

        var defer = $.when.apply($, privacyRequests);

        defer.done(function () {
            var percent = getPrivacyPercent(),
                cls = percent < 100 ? "privacy-red" : "privacy-green";

            $(".js-privacy-alert")
                .addClass(cls)
                .show()
                .find("span")
                .text(percent);
        });
    }

    $(".js-user-lang").text(
        navigator.language || navigator.userLanguage || "—"
    );

    $(".js-user-resolution").text(
        window.screen.availWidth +
            "x" +
            window.screen.availHeight +
            ", " +
            window.screen.colorDepth +
            " bit"
    );

    if (flashSupport()) {
        $(".js-flash-support-yes").show();
    } else {
        $(".js-flash-support-no").show();
    }

    if (navigator.javaEnabled && navigator.javaEnabled()) {
        $(".js-java-support-yes").show();
    } else {
        $(".js-java-support-no").show();
    }

    if (typeof window.ActiveXObject == "undefined") {
        $(".js-activex-support-no").show();
    } else {
        $(".js-activex-support-yes").show();
    }

    if (
        window.RTCPeerConnection ||
        window.webkitRTCPeerConnection ||
        window.mozRTCPeerConnection
    ) {
        $(".js-webrtc-support-yes").show();
    } else {
        $(".js-webrtc-support-no").show();
    }

    //menu

    $(".lang a.active").show();

    $(".lang a").click(function (e) {
        if ($(this).hasClass("active")) {
            e.preventDefault();

            $(this).siblings("a").slideToggle("fast");
        }
    });

    $(".js-ipv6-support-check").click(function () {
        var url = $(".js-url").val().trim(),
            btn = $(this);

        if (!url || btn.prop("disabled")) {
            return;
        }

        btn.prop("disabled", true);

        $(".js-ip6-support div").hide();

        $.ajax({
            method: "POST",

            url: "https://api.proxy-checker.net/api/site-ipv6-support/",

            data: { url: url },

            success: function (data) {
                // console.log(data);

                btn.prop("disabled", false);

                if (data.result) {
                    $(".js-ip6-support-yes").show();
                } else {
                    $(".js-ip6-support-no").show();
                }
            },
        });
    });

    $(document).ready(function () {
        let checkerBtn = $(".js-proxy-check");

        if (checkerBtn.length && checkerBtn.hasClass("auto-click"))
            checkerBtn.trigger("click");
    });

    $(".js-proxy-check").click(function (e) {
        var proxies = validateProxies(
                $(".js-proxy-list").val().trim().split("\n")
            ),
            btn = $(this),
            requests = [],
            anonLevels = TRANSLATIONS.anonymity_levels || {},
            currentRequests = 0,
            i,
            proxies1,
            proxies2;

        if (btn.prop("disabled")) {
            alert("Wait until checking is over");

            return;
        }

        btn.prop("disabled", true);

        if (!proxies.length) {
            alert("Fill proxy list");

            btn.prop("disabled", false);

            return;
        }

        if (proxies.length > 1000) {
            alert("1000 proxies maximum");

            btn.prop("disabled", false);

            return;
        }

        $(".js-check-result").show();

        proxies = splitArray(proxies, CHECK_CHUNK_SIZE);

        proxies1 = proxies.slice(0, CONCURRENT_REQUESTS);

        proxies2 = proxies.slice(CONCURRENT_REQUESTS).reverse();

        function request(proxyList) {
            currentRequests++;

            return $.ajax({
                url: "https://api.proxy-checker.net/api/proxy-checker/",

                type: "POST",

                data: {
                    proxy_list: proxyList.join("\n"),
                },

                complete: function () {
                    currentRequests--;
                },

                success: function (data) {
                    var valid = 0,
                        invalid = 0,
                        country,
                        row,
                        j,
                        c,
                        p;

                    for (j = 0; j < data.length; j++) {
                        p = data[j];

                        CHECKED_PROXIES.push(p);

                        if (p.valid) {
                            valid++;
                        } else {
                            invalid++;
                        }

                        if (p.data.country_name && p.data.city) {
                            country = [p.data.country_name, p.data.city].join(
                                ", "
                            );
                        } else if (p.data.country_name) {
                            country = p.data.country_name;
                        } else {
                            country = EMPTY_VALUE;
                        }

                        row = [
                            p.ip,

                            p.port,

                            // country,

                            p.data.connection_time || EMPTY_VALUE,

                            (p.protocol || EMPTY_VALUE).toUpperCase(),

                            anonLevels[p.data.anonymity_level] || EMPTY_VALUE,
                        ];

                        resultTable.row.add(row).draw(false);
                    }

                    $(".js-check-result").show();

                    incrValidNum(valid);

                    incrInvalidNum(invalid);

                    if (
                        currentRequests < CONCURRENT_REQUESTS &&
                        proxies2.length > 0
                    ) {
                        for (
                            c = 0;
                            c < CONCURRENT_REQUESTS - currentRequests;
                            c++
                        ) {
                            var proxies = proxies2.pop();

                            if (proxies !== undefined) {
                                requests.push(request(proxies));
                            }
                        }
                    }
                },

                error: function (data) {
                    var alerts = errorsToAlerts(data.responseJSON);

                    $(".js-alerts").html(alerts.join("")).show();

                    console.log(alerts);
                },
            });
        }

        for (i = 0; i < proxies1.length; i++) {
            requests.push(request(proxies1[i]));
        }

        var defer = $.when.apply($, requests);

        defer.done(function () {
            btn.prop("disabled", false);
        });
    });

    $(".js-get-valid-proxies,.js-get-invalid-proxies").click(function () {
        var valid = $(this).hasClass("js-get-valid-proxies"),
            proxies = [],
            i;

        for (i = 0; i < CHECKED_PROXIES.length; i++) {
            if (CHECKED_PROXIES[i].valid === valid) {
                proxies.push(CHECKED_PROXIES[i].initial);
            }
        }

        $.fancybox.close();

        $.fancybox.open(
            '<div style="width:100%;max-width:400px;font-size:13px"><textarea rows="20">' +
                proxies.join("\n") +
                "</textarea></div>"
        );
    });

    if ($("#js-free-proxy-table").length !== 0) {
        $.ajax({
            method: "GET",

            url: "https://api.proxy-checker.net/api/free-proxy-list/",

            success: function (data) {
                var tableData = [];

                for (var i = 0; i < data.length; i++) {
                    //tableData.push([data[i].ip, data[i].port, data[i].country + ', ' + data[i].city,data[i].protocol, data[i].anonymity])

                    tableData.push([
                        "<span class='copy_t'></span> " + data[i].ip,
                        data[i].port,
                        '<img src="/assets/images/flags/' +
                            data[i].country +
                            '.png" /> ' +
                            data[i].country +
                            ", " +
                            data[i].city,

                        data[i].protocol,
                        data[i].anonymity,
                    ]);
                }

                $("#js-free-proxy-table").DataTable({
                    searching: false,

                    ordering: false,

                    info: false,

                    pagingType: "simple_numbers",

                    pageLength: PAGE_LENGTH,

                    lengthChange: false,

                    pageLength: 20,

                    language: {
                        paginate: {
                            previous: "<",

                            next: ">",

                            first: "|<",

                            last: ">|",
                        },
                    },

                    data: tableData,

                    columns: [
                        { title: "IP" },

                        { title: "Порт" },

                        { title: "Страна, город" },

                        { title: "Тип" },

                        { title: "Анонимность" },
                    ],
                });

                // console.log(data);
            },
        });
    }

    let resiltTableElement = $("#js-result-table");

    if (resiltTableElement.length) {
        var resultTable = resiltTableElement.DataTable({
            searching: false,

            ordering: false,

            info: false,

            pageLength: 200,

            pagingType: "simple_numbers",

            //pageLength: PAGE_LENGTH,

            lengthChange: false,

            language: {
                paginate: {
                    previous: "←",

                    next: "→",

                    first: "|<",

                    last: ">|",
                },
            },

            data: [],

            columns: [
                { title: "IP" },

                { title: "Порт" },

                { title: "Скорость, сек" },

                { title: "Тип" },

                { title: "Анонимность" },
            ],
        });
    }

    $(".js-show-all").click(function (e) {
        e.preventDefault();

        resultTable.page.len(-1).draw();
    });

    $(".js-clear-result-table").click(function (e) {
        console.log("clear click");

        e.preventDefault();

        resultTable.rows().remove().draw();

        $(".js-valid-num").text(0);

        $(".js-invalid-num").text(0);
    });

    $(".js-speed-test").click(function (e) {
        e.preventDefault();

        var btn = $(this);

        if (btn.prop("disabled")) {
            return;
        }

        btn.prop("disabled", true);

        SpeedTest.ping(function (ping) {
            // console.log(ping);

            $(".js-ping").text(ping);

            var percent = ping > 100 ? 100 : 100 - ping;

            $(".js-ping-line").css({ width: percent + "%", animation: "none" });

            SpeedTest.download(function (speed) {
                // console.log(speed);

                $(".js-download-speed").text(speed);

                $(".js-download-line").css({
                    width: speed + "%",
                    animation: "none",
                });

                SpeedTest.upload(function (speed) {
                    // console.log(speed);

                    $(".js-upload-speed").text(speed);

                    $(".js-upload-line").css({
                        width: speed + "%",
                        animation: "none",
                    });

                    btn.prop("disabled", false);
                });
            });
        });
    });

    $(".js-blacklist-check").click(function () {
        var ip = $(".js-ip").val().trim(),
            lists = $(".black-list"),
            btn = $(this),
            url = $(),
            requests = [];

        if (!ip || btn.prop("disabled")) {
            return;
        }

        btn.prop("disabled", true);

        $(".blacklist-info").show();

        $(".blacklist-info span").text(0);

        lists.each(function () {
            var el = $(this);

            el.show().removeClass("no yes").addClass("checking");

            requests.push(
                $.ajax({
                    url: "https://api.proxy-checker.net/api/blacklist-check/",

                    method: "POST",

                    data: { ip: ip, blacklist: el.data("list") },

                    success: function (data) {
                        // console.log(data);

                        var cls = data.result ? "no" : "yes";

                        el.removeClass("checking").addClass(cls);

                        $(".js-checking").text(lists.filter(":visible").length);

                        $(".js-yes").text(lists.filter(".yes").length);

                        $(".js-no").text(lists.filter(".no").length);
                    },
                })
            );
        });

        var defer = $.when.apply($, requests);

        defer.done(function () {
            btn.prop("disabled", false);
        });
    });

    $(".js-port-check").click(function () {
        var ip = $(".js-ip").val().trim(),
            port = $(".js-port").val().trim(),
            btn = $(this);

        if (!ip || !port || btn.prop("disabled")) {
            return;
        }

        btn.prop("disabled", true);

        // console.log(ip, port);

        $.ajax({
            method: "POST",

            url: "https://api.proxy-checker.net/api/port-check/",

            data: { ip: ip, port: port },

            success: function (data) {
                btn.prop("disabled", false);

                $(".js-port-check-status div").hide();

                if (data.result) {
                    $(".js-port-opened").show().find("b").text(port);
                } else {
                    $(".js-port-closed").show().find("b").text(port);
                }

                // console.log(data);
            },
        });
    });

    //form

    $(".ajaxform").submit(function () {
        $.ajax({
            type: "POST",

            data: $(this).serialize(),

            success: function () {
                $.fancybox.close();

                $.fancybox.open({
                    src: "#thanks",

                    type: "inline",
                });

                $(
                    'input[type="text"], input[type="tel"], input[type="email"], textarea'
                ).val("");
            },
        });

        return false;
    });

    //open map

    $("a[data-map]").click(function () {
        var lat = $(this).data("lat"),
            long = $(this).data("long");

        $.fancybox.open('<div id="map" ></div>');

        map_yandex("#map", lat, long, 9);
    });

    function map_yandex(el, lat, lon, zoom) {
        var el = $(el);

        if (el.length) {
            $.ajax({
                url: "https://api-maps.yandex.ru/2.1/?lang=ru_RU",

                dataType: "script",

                cache: true,

                success: function () {
                    ymaps.ready(mapblock);
                },
            });

            function mapblock() {
                el.empty();

                var id = el.attr("id"),
                    mymap = new ymaps.Map(id, {
                        center: [lat, lon],

                        zoom: zoom,

                        controls: ["zoomControl"],
                    });

                mymap.behaviors.disable("scrollZoom");

                var marker = new ymaps.Placemark([lat, lon]);

                mymap.geoObjects.add(marker);
            }
        }
    }
});
