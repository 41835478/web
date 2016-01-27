function user_c(t) {
    var e = "",
    n = "",
    o = "",
    a = encodeURIComponent(window.document.location.href),
    i = window["BD_PS_C" + (new Date).getTime()] = new Image;
    for (v in t) {
        switch (v) {
        case "title":
            n = encodeURIComponent(t[v].replace(/<[^<>]+>/g, ""));
            break;
        case "url":
            n = encodeURIComponent(t[v]);
            break;
        default:
            n = t[v]
        }
        e += v + "=" + n + "&"
    }
    return o = "&mu=" + a,
    i.src = "http://nsclick.baidu.com/v.gif?pid=201&pj=psuser&" + e + "path=" + a + "&t=" + (new Date).getTime(),
    !0
}
function RelMap(t) {
    function e() {
        var t = h / 3,
        e = 0,
        o = 0,
        a = {};
        r.strokeStyle = f;
        for (var i = p - 1; i >= 0; i--) r.beginPath(),
        r.moveTo(l, u),
        i % 2 ? (e = l - 190, o = u - 50) : (e = l - 70, o = u - 10),
        a = n(e, o, t),
        r.lineTo(a.x + l, a.y + u),
        r.stroke(),
        r.closePath(),
        i % 2 ? m.push([a.x + l, a.y + u]) : g.push([a.x + l, a.y + u]),
        t += h
    }
    function n(t, e, n) {
        var o = Math.cos(n) * t,
        a = Math.sin(n) * e;
        return {
            x: o,
            y: a
        }
    }
    function o() {
        var t, e = 0,
        n = 0,
        o = 0,
        a = 0,
        i = null;
        d.each(function() {
            t = $(this),
            e = t.outerWidth(),
            n = t.outerHeight(),
            t.hasClass("co_map_person_big") ? (i = m[o], o += 1) : (i = g[a], a += 1),
            i && t.css({
                top: i[1] - n / 2,
                left: i[0] - e / 2
            })
        })
    }
    function a() {
        var t = $(".co_relmap_tips");
        d.on("mouseover",
        function() {
            var e = $(this),
            n = e.outerWidth(),
            o = e.outerHeight(),
            a = 0,
            i = 0,
            r = e.find(".co_person_name"),
            c = r.attr("affiliate"),
            l = r.attr("paper-count"),
            u = r.text(),
            d = parseInt(e.css("top")),
            f = parseInt(e.css("left")),
            p = "<p><span>姓名：</span>" + u + "</p><p><span>机构：</span>" + c + "</p><p><span>合作次数：</span>" + l + "</p>";
            t.html(p),
            i = t.outerHeight(),
            a = t.outerWidth(),
            d -= i,
            f = f - a / 2 + n / 2,
            0 >= d && (d += i + o),
            f + a >= s ? f = s - a - 20 : 0 >= f && (f = 20),
            t.css({
                top: d,
                left: f
            }),
            "none" === t.css("display") && t.show()
        }),
        $(".co_relmap_wrapper").on("mouseleave",
        function() {
            t.css("display", "none")
        })
    }
    var i = t.canvas,
    r = i.getContext("2d"),
    s = i.width,
    c = i.height,
    l = s / 2,
    u = c / 2,
    d = $("." + t.relAuClass),
    f = "#ffdfca",
    p = t.count || 20,
    h = 2 * Math.PI / p,
    g = [],
    m = [];
    this.render = function() {
        e(),
        o(),
        a()
    }
} !
function(t) {
    function e() {
        if (bds && bds.qa && bds.qa.ShortCut && bds.qa.ShortCut.initRightBar) {
            var t = {
                product_id: 65
            };
            bds.qa.ShortCut.initRightBar(t);
            var e = {
                product_id: "65",
                username: bds.comm.username,
                query: ""
            };
            bds.qa.ShortCut._getProData(e)
        }
    }
    function n() {
        bds && bds.qa && bds.qa.ShortCut && bds.qa.ShortCut.initRightBar ? e() : t.ajax({
            url: "http://f3.baidu.com/feedback/js/feedback/feedback0.0.2.js",
            dataType: "script",
            success: function() {
                e()
            }
        })
    }
    bds.util.feedback = function() {
        n()
    },
    t("body").on("click", ".feedback",
    function(t) {
        bds.util.feedback(),
        t.preventDefault()
    })
} (jQuery),
bds.util.dialogTips = function(t, e) {
    var n = "",
    o = "",
    a = $(".subsDialog");
    if (200 == t ? (n = e || "操作成功", o = "c-icon-ok") : (n = e || "操作失败", o = "c-icon-fail"), a.length) a.find(".texttip").text(n),
    a.find(".c-icon").removeClass("c-icon-ok c-icon-fail").addClass(o);
    else {
        var i = ['<div class="subsDialog">', '<i class="c-icon ' + o + '"></i>', '<span class="texttip">' + n + "</span>", "</div>"].join("");
        $(i).appendTo("body"),
        a = $(".subsDialog"),
        a.css({
            height: "42px",
            padding: "0 20px",
            color: "#69c",
            "font-size": "14px",
            "line-height": "42px",
            "text-align": "center",
            border: "1px solid #ccc",
            "background-color": "#fff",
            position: "absolute",
            display: "none",
            "z-index": "1001"
        }),
        a.find(".texttip").css({
            "padding-left": "6px",
            _zoom: 1
        }),
        a.find(".c-icon").css({
            _display: "none"
        })
    }
    var r = ($(window).height() - a.outerHeight()) / 2,
    s = ($(window).width() - a.outerWidth()) / 2,
    c = $(window).scrollTop() + Math.max(r, 10);
    a.css({
        top: c,
        left: s
    }).fadeIn(),
    setTimeout(function() {
        a.fadeOut()
    },
    1e3)
},
$.getScript("http://passport.baidu.com/passApi/js/uni_login_wrapper.js?cdnversion=" + (new Date).getTime(),
function() {
    bds.se.passv3 = passport.pop.init({
        apiOpt: {
            loginType: 1,
            product: "xueshu",
            subpro: bds.comm.subpro || "",
            u: window.document.location.href,
            safeFlag: 0,
            staticPage: "http://" + window.document.location.href.split("/")[2] + "/cache/scholar/static/user/html/v3Jump.html"
        },
        cache: !1,
        tangram: !0,
        authsite: ["qzone", "tsina"],
        authsiteCfg: {
            act: "implicit",
            display: "popup",
            jumpUrl: "http://" + window.document.location.href.split("/")[2] + "/cache/scholar/static/user/html/xd.html",
            onBindSuccess: function(t, e) {
                var n = decodeURIComponent(e.passport_uname || e.displayname);
                return bds.se.login.success(n),
                !1
            }
        },
        onLoginSuccess: function(t) {
            t.returnValue = !1;
            var e = t.rsp.data.userName || t.rsp.data.mail || t.rsp.data.phoneNumber;
            bds.se.login.success(e)
        },
        onSubmitStart: function() {},
        onSubmitedErr: function() {},
        onSystemErr: function() {},
        onShow: function() {},
        onHide: function() {
            bds.se.login.setSubpro(bds.comm.subpro)
        },
        onDestroy: function() {}
    })
}),
bds.se.loginCallbackFunc = null,
bds.se.login = {
    init: function() {
        this.setUserInfo();
        var t = this;
        bds.comm.loginAction.push(function(e, n) {
            t.setUserInfo(n)
        })
    },
    setUserInfo: function(t) {
        var e = t || bds.comm.user;
        if (!e) return void $("#u .reg").attr("href", "https://passport.baidu.com/v2/?reg&regType=1&tpl=xueshu&u=" + encodeURIComponent(document.location.href));
        var n = $("#user");
        n.find(".logout").attr("href", "http://passport.baidu.com/?logout&tpl=xueshu&u=" + encodeURIComponent(document.location.href))
    },
    open: function(t) {
        bds.se.loginCallbackFunc = t ||
        function() {
            window.document.location.reload(!0)
        },
        bds.se.passv3.show()
    },
    success: function(t) {
        if (bds.comm) {
            bds.comm.user = t,
            bds.comm.username = t,
            window.bdUser = t,
            bds.se.passv3.hide(),
            bds.se.loginCallbackFunc.call(window, 1, t);
            for (var e = 0; e < bds.comm.loginAction.length; e++) bds.comm.loginAction[e].call(window, 1, t)
        }
    },
    setSubpro: function(t) {
        bds.se.passv3.setSubpro(t)
    }
},
bds.se.login.init(),
!
function() {
    function t(t, e) {
        $(".menuDropList").hide(),
        $(".menuarrow").hide();
        var n = $(window).width() - t.offset().left + window.scrollX,
        o = parseInt(e.css("left")),
        a = e.width() + 10,
        i = a + o;
        if (i > n) {
            var r = o - (i - n);
            e.css("left", r)
        }
        e.show(),
        e.siblings(".menuarrow").show(),
        $("#s_mod_msg").hide()
    }
    function e(t) {
        t.hide(),
        t.siblings(".menuarrow").hide()
    }
    function n(n, o, a) {
        n.on("mouseover",
        function() {
            t(n, o),
            a && (clearTimeout(a), a = !1)
        }).on("mouseout",
        function() {
            a && (clearTimeout(a), a = !1),
            a = setTimeout(function() {
                e(o)
            },
            200)
        }),
        o.on("mouseover",
        function() {
            a && (clearTimeout(a), a = !1)
        }).on("mouseout",
        function() {
            a && (clearTimeout(a), a = !1),
            a = setTimeout(function() {
                e(o)
            },
            200)
        })
    }
    var o, a, i, r = $("#bdbri"),
    s = $("#bdbriList"),
    c = $("#setting"),
    l = $("#setMenu"),
    u = $("#user #userMenu"),
    d = $("#user");
    n(r, s, o),
    n(c, l, a),
    0 !== d.length && n(d, u, i),
    $("#lb") && $("#lb").click(function() {
        return bds.se.login.open(),
        !1
    })
} (),
function() {
    $("#imsg").length && $.ajax({
        url: "http://s1.bdstatic.com/r/www/cache/mid/static/xueshu_mt/js/message_1.1.js",
        dataType: "script",
        success: function() {
            var t = $("#s_mod_msg");
            bds.se.message && bds.se.message.init && bds.se.message.init({
                container: t,
                msgbtn: $("#imsg"),
                hasborder: 1,
                msgGetCb: function(t) {
                    t && t.length && $(".fixed_menu_containter .message_new_icon").css("display", "inline-block")
                },
                msgCleanCb: function() {
                    $(".fixed_menu_containter .message_new_icon").hide()
                }
            })
        }
    })
} (),
jQuery && jQuery.extend({
    stringify: function(t) {
        function e(t) {
            return /["\\\x00-\x1f]/.test(t) && (t = t.replace(/["\\\x00-\x1f]/g,
            function(t) {
                var e = a[t];
                return e ? e: (e = t.charCodeAt(), "\\u00" + Math.floor(e / 16).toString(16) + (e % 16).toString(16))
            })),
            '"' + t + '"'
        }
        function n(t) {
            var e, n, o, a = ["["],
            i = t.length;
            for (n = 0; i > n; n++) switch (o = t[n], typeof o) {
            case "undefined":
            case "function":
            case "unknown":
                break;
            default:
                e && a.push(","),
                a.push($.stringify(o)),
                e = 1
            }
            return a.push("]"),
            a.join("")
        }
        if ("JSON" in window) return JSON.stringify(t);
        var o = typeof t;
        if ("object" != o || null === t) return "string" == o && (t = '"' + t + '"'),
        String(t);
        var a = {
            "\b": "\\b",
            "	": "\\t",
            "\n": "\\n",
            "\f": "\\f",
            "\r": "\\r",
            '"': '\\"',
            "\\": "\\\\"
        };
        switch (typeof t) {
        case "undefined":
            return "undefined";
        case "number":
            return isFinite(t) ? String(t) : "null";
        case "string":
            return e(t);
        case "boolean":
            return String(t);
        default:
            if (null === t) return "null";
            if (t instanceof Array) return n(t);
            var i, r, s = ["{"],
            c = $.stringify;
            for (var l in t) if (Object.prototype.hasOwnProperty.call(t, l)) switch (r = t[l], typeof r) {
            case "undefined":
            case "unknown":
            case "function":
                break;
            default:
                i && s.push(","),
                i = 1,
                s.push(c(l) + ":" + c(r))
            }
            return s.push("}"),
            s.join("")
        }
    },
    format: function(t, e) {
        t = String(t);
        var n = Array.prototype.slice.call(arguments, 1),
        o = Object.prototype.toString;
        return n.length ? (n = 1 == n.length && null !== e && /\[object Array\]|\[object Object\]/.test(o.call(e)) ? e: n, t.replace(/#\{(.+?)\}/g,
        function(t, e) {
            var a = n[e];
            return "[object Function]" == o.call(a) && (a = a(e)),
            "undefined" == typeof a ? "": a
        })) : t
    },
    subByte: function(t, e, n) {
        var o = [],
        a = t.split("");
        n = n || "…";
        for (var i = 0,
        r = a.length; r > i; i++) a[i].charCodeAt(0) > 255 && o.push("*"),
        o.push(a[i]);
        return e && e > 0 && o.length > e ? a = o.join("").substring(0, e - 1).replace(/\*/g, "") + n: t
    },
    getByteLength: function(t) {
        for (var e = [], n = t.split(""), o = 0, a = n.length; a > o; o++) n[o].charCodeAt(0) > 255 && e.push("*"),
        e.push(n[o]);
        return e.length
    },
    _isValidKey: function(t) {
        return new RegExp('^[^\\x00-\\x20\\x7f\\(\\)<>@,;:\\\\\\"\\[\\]\\?=\\{\\}\\/\\u0080-\\uffff]+$').test(t)
    },
    setCookie: function(t, e, n) {
        if (e = encodeURIComponent(e), jQuery._isValidKey(t)) {
            n = n || {};
            var o = n.expires;
            "number" == typeof n.expires && (o = new Date, o.setTime(o.getTime() + n.expires)),
            document.cookie = t + "=" + e + (n.path ? "; path=" + n.path: "") + (o ? "; expires=" + o.toGMTString() : "") + (n.domain ? "; domain=" + n.domain: "") + (n.secure ? "; secure": "")
        }
    },
    getCookie: function(t) {
        var e = "";
        if (jQuery._isValidKey(t)) {
            var n = new RegExp("(^| )" + t + "=([^;]*)(;|$)"),
            o = n.exec(document.cookie);
            if (o && (e = o[2] || null, "string" == typeof e)) return e = decodeURIComponent(e)
        }
        return null
    },
    removeCookie: function(t, e) {
        e = e || {},
        e.expires = new Date(0),
        jQuery.setCookie(t, "", e)
    }
}),
"object" != typeof JSON && (JSON = {}),
function() {
    "use strict";
    function f(t) {
        return 10 > t ? "0" + t: t
    }
    function this_value() {
        return this.valueOf()
    }
    function quote(t) {
        return rx_escapable.lastIndex = 0,
        rx_escapable.test(t) ? '"' + t.replace(rx_escapable,
        function(t) {
            var e = meta[t];
            return "string" == typeof e ? e: "\\u" + ("0000" + t.charCodeAt(0).toString(16)).slice( - 4)
        }) + '"': '"' + t + '"'
    }
    function str(t, e) {
        var n, o, a, i, r, s = gap,
        c = e[t];
        switch (c && "object" == typeof c && "function" == typeof c.toJSON && (c = c.toJSON(t)), "function" == typeof rep && (c = rep.call(e, t, c)), typeof c) {
        case "string":
            return quote(c);
        case "number":
            return isFinite(c) ? String(c) : "null";
        case "boolean":
        case "null":
            return String(c);
        case "object":
            if (!c) return "null";
            if (gap += indent, r = [], "[object Array]" === Object.prototype.toString.apply(c)) {
                for (i = c.length, n = 0; i > n; n += 1) r[n] = str(n, c) || "null";
                return a = 0 === r.length ? "[]": gap ? "[\n" + gap + r.join(",\n" + gap) + "\n" + s + "]": "[" + r.join(",") + "]",
                gap = s,
                a
            }
            if (rep && "object" == typeof rep) for (i = rep.length, n = 0; i > n; n += 1)"string" == typeof rep[n] && (o = rep[n], a = str(o, c), a && r.push(quote(o) + (gap ? ": ": ":") + a));
            else for (o in c) Object.prototype.hasOwnProperty.call(c, o) && (a = str(o, c), a && r.push(quote(o) + (gap ? ": ": ":") + a));
            return a = 0 === r.length ? "{}": gap ? "{\n" + gap + r.join(",\n" + gap) + "\n" + s + "}": "{" + r.join(",") + "}",
            gap = s,
            a
        }
    }
    var rx_one = /^[\],:{}\s]*$/,
    rx_two = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
    rx_three = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
    rx_four = /(?:^|:|,)(?:\s*\[)+/g,
    rx_escapable = /[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    rx_dangerous = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
    "function" != typeof Date.prototype.toJSON && (Date.prototype.toJSON = function() {
        return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z": null
    },
    Boolean.prototype.toJSON = this_value, Number.prototype.toJSON = this_value, String.prototype.toJSON = this_value);
    var gap, indent, meta, rep;
    "function" != typeof JSON.stringify && (meta = {
        "\b": "\\b",
        "	": "\\t",
        "\n": "\\n",
        "\f": "\\f",
        "\r": "\\r",
        '"': '\\"',
        "\\": "\\\\"
    },
    JSON.stringify = function(t, e, n) {
        var o;
        if (gap = "", indent = "", "number" == typeof n) for (o = 0; n > o; o += 1) indent += " ";
        else "string" == typeof n && (indent = n);
        if (rep = e, e && "function" != typeof e && ("object" != typeof e || "number" != typeof e.length)) throw new Error("JSON.stringify");
        return str("", {
            "": t
        })
    }),
    "function" != typeof JSON.parse && (JSON.parse = function(text, reviver) {
        function walk(t, e) {
            var n, o, a = t[e];
            if (a && "object" == typeof a) for (n in a) Object.prototype.hasOwnProperty.call(a, n) && (o = walk(a, n), void 0 !== o ? a[n] = o: delete a[n]);
            return reviver.call(t, e, a)
        }
        var j;
        if (text = String(text), rx_dangerous.lastIndex = 0, rx_dangerous.test(text) && (text = text.replace(rx_dangerous,
        function(t) {
            return "\\u" + ("0000" + t.charCodeAt(0).toString(16)).slice( - 4)
        })), rx_one.test(text.replace(rx_two, "@").replace(rx_three, "]").replace(rx_four, ""))) return j = eval("(" + text + ")"),
        "function" == typeof reviver ? walk({
            "": j
        },
        "") : j;
        throw new SyntaxError("JSON.parse")
    })
} (),
bds.se.cookie = function() {
    function t(t, e, n) {
        var o = window.location.hostname;
        n = n || {},
        "www.baidu.com" !== o && (n.path = "/", n.domain = o, $.setCookie(t, e, n))
    }
    function e(t) {
        return $.getCookie(t)
    }
    return {
        get: e,
        set: t
    }
} ();
var supportStyle = function() {
    var t = document.createElement("div"),
    e = "Khtml Ms O Moz Webkit".split(" "),
    n = e.length;
    return function(o) {
        if (o in t.style) return ! 0;
        for (o = o.replace(/^[a-z]/,
        function(t) {
            return t.toUpperCase()
        }); n--;) if (e[n] + o in t.style) return ! 0;
        return ! 1
    }
} (); !
function() {
    var t = $("#left_menu_content"),
    e = $("#pagemain_content"),
    n = 57,
    o = 32,
    a = supportStyle("Transform");
    t.mouseenter(function() {
        var o = t.outerWidth(),
        i = $(".menu_mulit_list").height();
        if (a) {
            var r = o - n;
            e.css({
                "-webkit-transform": "translate3d(" + r + "px, 0, 0)",
                "-mos-transform": "translate3d(" + r + "px, 0, 0)",
                "-ms-transform": "translate3d(" + r + "px, 0, 0)",
                transform: "translate3d(" + r + "px, 0, 0)"
            })
        } else e.css("margin-left", o),
        $("body").addClass("menushow"),
        t.find("a").css("margin-left", "18px");
        t.addClass("menushow"),
        $(".menu_listhidden").height(i)
    }).mouseleave(function() {
        $(".menu_listhidden").height(o),
        t.removeClass("menushow"),
        a ? e.css({
            "-webkit-transform": "translate3d(0, 0, 0)",
            "-mos-transform": "translate3d(0, 0, 0)",
            "-ms-transform": "translate3d(0, 0, 0)",
            transform: "translate3d(0, 0, 0)"
        }) : (e.css("margin-left", n), t.find("a").css("margin-left", "0"), setTimeout(function() {
            $("body").removeClass("menushow")
        },
        200))
    })
} (),
!
function() {
    function t(t, e) {
        if (null == t.getAttribute("data-nolog")) {
            var n, o, a = {},
            i = t;
            do {
                if (null != i.getAttribute("data-nolog")) return;
                if (n = i.getAttribute("data-log")) try {
                    n = new Function("return " + n)();
                    for (o in n)"undefined" == typeof a[o] && n.hasOwnProperty(o) && (a[o] = n[o])
                } catch(r) {}
                i = i.parentNode
            } while ( i && i !== e . parentNode );
            a.type && a.actblock && (a.type = a.actblock + "-" + a.type, window.c(a))
        }
    }
    var e = "LOG_WR";
    $("body").on("mousedown",
    function(n) {
        var n = window.event || n,
        o = n.srcElement || n.target,
        a = $(o);
        try {
            for (var i, r = a; r.length && !r.hasClass(e);) r = r.parent();
            if (!r.length) return;
            i = r.get(0),
            t(o, i)
        } catch(n) {}
    })
} (),
"object" != typeof JSON && (JSON = {}),
function() {
    "use strict";
    function f(t) {
        return 10 > t ? "0" + t: t
    }
    function this_value() {
        return this.valueOf()
    }
    function quote(t) {
        return rx_escapable.lastIndex = 0,
        rx_escapable.test(t) ? '"' + t.replace(rx_escapable,
        function(t) {
            var e = meta[t];
            return "string" == typeof e ? e: "\\u" + ("0000" + t.charCodeAt(0).toString(16)).slice( - 4)
        }) + '"': '"' + t + '"'
    }
    function str(t, e) {
        var n, o, a, i, r, s = gap,
        c = e[t];
        switch (c && "object" == typeof c && "function" == typeof c.toJSON && (c = c.toJSON(t)), "function" == typeof rep && (c = rep.call(e, t, c)), typeof c) {
        case "string":
            return quote(c);
        case "number":
            return isFinite(c) ? String(c) : "null";
        case "boolean":
        case "null":
            return String(c);
        case "object":
            if (!c) return "null";
            if (gap += indent, r = [], "[object Array]" === Object.prototype.toString.apply(c)) {
                for (i = c.length, n = 0; i > n; n += 1) r[n] = str(n, c) || "null";
                return a = 0 === r.length ? "[]": gap ? "[\n" + gap + r.join(",\n" + gap) + "\n" + s + "]": "[" + r.join(",") + "]",
                gap = s,
                a
            }
            if (rep && "object" == typeof rep) for (i = rep.length, n = 0; i > n; n += 1)"string" == typeof rep[n] && (o = rep[n], a = str(o, c), a && r.push(quote(o) + (gap ? ": ": ":") + a));
            else for (o in c) Object.prototype.hasOwnProperty.call(c, o) && (a = str(o, c), a && r.push(quote(o) + (gap ? ": ": ":") + a));
            return a = 0 === r.length ? "{}": gap ? "{\n" + gap + r.join(",\n" + gap) + "\n" + s + "}": "{" + r.join(",") + "}",
            gap = s,
            a
        }
    }
    var rx_one = /^[\],:{}\s]*$/,
    rx_two = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
    rx_three = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
    rx_four = /(?:^|:|,)(?:\s*\[)+/g,
    rx_escapable = /[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    rx_dangerous = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
    "function" != typeof Date.prototype.toJSON && (Date.prototype.toJSON = function() {
        return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z": null
    },
    Boolean.prototype.toJSON = this_value, Number.prototype.toJSON = this_value, String.prototype.toJSON = this_value);
    var gap, indent, meta, rep;
    "function" != typeof JSON.stringify && (meta = {
        "\b": "\\b",
        "	": "\\t",
        "\n": "\\n",
        "\f": "\\f",
        "\r": "\\r",
        '"': '\\"',
        "\\": "\\\\"
    },
    JSON.stringify = function(t, e, n) {
        var o;
        if (gap = "", indent = "", "number" == typeof n) for (o = 0; n > o; o += 1) indent += " ";
        else "string" == typeof n && (indent = n);
        if (rep = e, e && "function" != typeof e && ("object" != typeof e || "number" != typeof e.length)) throw new Error("JSON.stringify");
        return str("", {
            "": t
        })
    }),
    "function" != typeof JSON.parse && (JSON.parse = function(text, reviver) {
        function walk(t, e) {
            var n, o, a = t[e];
            if (a && "object" == typeof a) for (n in a) Object.prototype.hasOwnProperty.call(a, n) && (o = walk(a, n), void 0 !== o ? a[n] = o: delete a[n]);
            return reviver.call(t, e, a)
        }
        var j;
        if (text = String(text), rx_dangerous.lastIndex = 0, rx_dangerous.test(text) && (text = text.replace(rx_dangerous,
        function(t) {
            return "\\u" + ("0000" + t.charCodeAt(0).toString(16)).slice( - 4)
        })), rx_one.test(text.replace(rx_two, "@").replace(rx_three, "]").replace(rx_four, ""))) return j = eval("(" + text + ")"),
        "function" == typeof reviver ? walk({
            "": j
        },
        "") : j;
        throw new SyntaxError("JSON.parse")
    })
} (),
!
function() {
    function t(t) {
        function e(t, e, n) {
            return n && (t = t > n ? n: t),
            t >= e ? t: e
        }
        function n(t) {
            t ? M.call(window, {
                value: Q,
                scale: A
            }) : O.call(window, {
                value: Q,
                scale: A
            })
        }
        function o() {
            p && clearInterval(p),
            i(),
            p = setInterval(function() {
                Z ? i() : clearInterval(p)
            },
            100)
        }
        function a() {
            h && clearInterval(h),
            r(),
            h = setInterval(function() {
                te ? r() : clearInterval(h)
            },
            100)
        }
        function i() {
            var t = Q - k;
            t = 0 > t ? 0 : t,
            u(t)
        }
        function r() {
            var t = Q + k;
            t = t > 1 ? 1 : t,
            u(t)
        }
        function s(t) {
            t = window.event || t;
            var n = e(t.clientY - Y, z, L);
            return Q = (n - z) / (L - z),
            $(q).css({
                top: n + "px"
            }),
            !1
        }
        function c() {
            return $(m).removeClass("opui-scroll-ctrl-scroll-hover"),
            $(m).removeClass("opui-scroll-ctrl-scroll-touch"),
            $(q).removeClass("opui-scroll-slider-hover"),
            $(q).removeClass("opui-scroll-slider-touch"),
            $(_).css({
                "-moz-user-select": ""
            }),
            $(_).css({
                "-webkit-user-select": ""
            }),
            V && window.clearInterval(V),
            document.onselectstart = K ? K: function() {
                return ! 0
            },
            $(document).unbind("mousemove", s),
            $(document).unbind("mouseup", c),
            $(q).addClass("opui-scroll-slider OP_LOG_BTN"),
            G = 0,
            !1
        }
        function l(t) {
            u((t.offsetY || t.layerY) / R)
        }
        function u(t, e, o) {
            t = 0 > t ? 0 : t,
            t = t > 1 ? 1 : t,
            Q = t;
            var a = (L - z) * Q + z;
            $(q).css({
                top: a + "px"
            }),
            e || n(o)
        }
        function d(t) {
            if (t.preventDefault(), t = t.originalEvent) {
                this.onwheel = 1;
                var e = ( - t.wheelDelta || t.detail && 40 * t.detail || 0) / C,
                n = e,
                o = n > 0 ? v.scrollTop + 2 : v.scrollTop - 2;
                $(_).css({
                    zoom: "1"
                });
                var a = _.offsetHeight - v.offsetHeight;
                o > 0 && a > o ? (v.scrollTop += n, v.scrollTop > a && (v.scrollTop = a), Q = v.scrollTop / (v.scrollHeight - v.offsetHeight)) : x && "none" != $(m).css("display") || (document.documentElement.scrollTop += n, document.body.scrollTop += n)
            }
        }
        function f(t) {
            if (A = t > 10 ? 10 : t, 1 >= A) return void $(q).css({
                display: "none"
            });
            $(q).css({
                display: "block"
            });
            var e = R - 2 * F;
            W = parseInt(e / A),
            W = 15 > W ? 15 : W,
            L = R - F - W,
            $(q).css({
                height: W + "px"
            })
        }
        this.options = t;
        var p, h, g, m = t.scrollbar || $("<div>").get(0),
        v = t.content,
        _ = $(t.content).children().get(0),
        b = t.initPos || 0,
        w = t.initDom || null,
        y = t.mousewheel || !0,
        x = t.mousewheellock || !1,
        C = t.wheeldelta || 1,
        T = t.ctrlblock || 0,
        k = t.step || .1,
        S = t.length,
        A = t.scale || 0,
        D = (t.theme || "", t.refresh || !1),
        j = 0,
        I = 0,
        P = 0,
        O = function(t) {
            var e = parseInt(j - I);
            if (e > 0) {
                var t = t.value;
                v.scrollTop = e * t
            }
        },
        M = function(t) {
            var e = parseInt(j - I);
            if (e > 0) {
                var t = t.value;
                v.scrollTop = parseInt(j * t) > e ? e: j * t
            }
        },
        N = $("<div>", {
            "class": "opui-scroll-up"
        }).get(0),
        E = $("<div>", {
            "class": "opui-scroll-down"
        }).get(0),
        H = $("<div>", {
            "class": "opui-scroll-axis"
        }).get(0),
        q = $("<div>", {
            "class": "opui-scroll-slider OP_LOG_BTN"
        }).get(0),
        J = $("<div>", {
            "class": "opui-scroll-s-top"
        }).get(0),
        B = $("<div>", {
            "class": "opui-scroll-s-bottom"
        }).get(0),
        U = $("<div>", {
            "class": "opui-scroll-s-block"
        }).get(0),
        R = 0,
        F = T || 0,
        W = 0,
        z = F,
        L = 0,
        Q = 0,
        Y = 0,
        G = 0,
        K = null,
        V = null,
        X = function() {
            Z = !1,
            te = !1
        };
        if (t.scrollbar || $(v).after($(m)), $(v).addClass("opui-scroll-ctrl-content"), $(m).addClass("opui-scroll-ctrl-scroll"), $(m).attr("data-click", '{fm:"beha"}'), this.render = function(t) {
            D || clearInterval(g);
            try {
                I = v.offsetHeight,
                P = m.offsetHeight,
                j = _.offsetHeight
            } catch(n) {}
            if (R = t || S || I - 2, $(m).css({
                height: R + "px"
            }), $(H).css({
                height: R + "px"
            }), R >= 0 && j >= 0) {
                R + 2 >= j ? $(m).hide() : $(m).show(),
                A != j / R && (A = j / R, f(A), u(0));
                var o = 0;
                if (w) {
                    o = w.offsetTop + w.scrollHeight >= j ? 1 : w.offsetTop + w.scrollHeight <= I ? 0 : w.offsetTop / j,
                    u(o);
                    var a = e(P * o, z);
                    a > R - W && (a = R - W)
                }
                if (b) {
                    u(b, !1, !0);
                    var a = e(P * b, z);
                    a > R - W && (a = R - W)
                }
            }
        },
        g = setInterval(this.render, 50), $(m).empty(), T && N.offsetHeight == E.offsetHeight) {
            var Z = !1,
            te = !1;
            m.appendChild(N),
            m.appendChild(E),
            $(N).on("mousedown",
            function() {
                o(),
                Z = !0
            }),
            $(E).on("mousedown",
            function() {
                a(),
                te = !0
            }),
            $(N).on("mouseup",
            function() {
                $(m).removeClass("opui-scroll-ctrl-scroll-touch"),
                Z = !1
            }),
            $(E).on("mouseup",
            function() {
                $(m).removeClass("opui-scroll-ctrl-scroll-touch"),
                te = !1
            }),
            $(document).on("mouseup", X)
        }
        m.appendChild(H),
        m.appendChild(q),
        q.appendChild(J),
        q.appendChild(B),
        q.appendChild(U),
        q.onDragstart = function() {
            return ! 1
        },
        $(q).on("mouseover",
        function() {
            $(q).addClass("opui-scroll-slider-hover"),
            $(m).addClass("opui-scroll-ctrl-scroll-hover")
        }),
        $(q).on("mousedown",
        function() {
            $(q).addClass("opui-scroll-slider-touch"),
            $(m).addClass("opui-scroll-ctrl-scroll-touch")
        }),
        $(q).on("mouseout",
        function() {
            $(q).removeClass("opui-scroll-slider-hover")
        }),
        $(q).on("mouseup",
        function() {
            $(q).removeClass("opui-scroll-slider-touch")
        }),
        $(m).on("mouseover",
        function() {
            $(m).addClass("opui-scroll-ctrl-scroll-hover")
        }),
        $(m).on("mousedown",
        function() {
            $(m).addClass("opui-scroll-ctrl-scroll-touch")
        }),
        $(m).on("mouseout",
        function() {
            $(m).removeClass("opui-scroll-ctrl-scroll-hover")
        }),
        $(m).on("mouseup",
        function() {
            $(m).removeClass("opui-scroll-ctrl-scroll-touch")
        }),
        $(H).on("click", l),
        y && !this.onwheel && ($(v).hasClass("opui-scroll-onwheel") || ($(v).on("DOMMouseScroll", d), $(v).on("mousewheel", d), $(v).addClass("opui-scroll-onwheel"))),
        v && $(v).on("scroll",
        function() {
            G || u(v.scrollTop / (v.scrollHeight - v.offsetHeight), 1)
        }),
        $(q).on("mousedown",
        function(t) {
            return K = document.onselectstart,
            document.onselectstart = function() {
                return ! 1
            },
            V = window.setInterval(n, 40),
            $(_).css({
                "-moz-user-select": "none"
            }),
            $(_).css({
                "-webkit-user-select": "none"
            }),
            Y = t.clientY - q.offsetTop,
            $(document).on("mousemove", s),
            $(document).on("mouseup", c),
            G = 1,
            t.preventDefault(),
            !1
        }),
        A > 1 && f(A),
        this.dispose = function() {
            document.onselectstart = K ? K: function() {
                return ! 0
            },
            $(document).unbind("mousemove", s),
            $(document).unbind("mouseup", c),
            $(document).unbind("mouseup", X),
            V && clearInterval(V),
            p && clearInterval(p),
            h && clearInterval(h),
            g && clearInterval(g)
        },
        this.setContentPos = function(t) {
            try {
                v.scrollTop = t
            } catch(e) {}
        }
    }
    A = window.A || {},
    A.ui = A.ui || {},
    A.ui.scrollbarv = function(e) {
        return new t(e)
    }
} (),
bds.comm.menuFixed = 0,
bds.util.setMenuHeight = function() {
    var t = $("body").height(),
    e = $(window).height(),
    n = $("#head").outerHeight();
    $("#left_menu_content").height(t > e ? t - e > n ? e: t - n: e - n),
    $("#pagemain_content").css("min-height", e - n)
},
bds.util.setMenuHeight(),
$(window).on("scroll",
function() {
    var t = $(window),
    e = t.scrollTop(),
    n = t.scrollLeft(),
    o = $("#head").outerHeight(),
    a = $("#left_menu_content"),
    i = $("#pagemain_content");
    e >= o && 0 === n && i.height() >= a.height() ? (a.addClass("s_down"), i.addClass("s_down")) : (a.removeClass("s_down"), i.removeClass("s_down"))
}),
$(window).on("resize",
function() {
    bds.util.setMenuHeight()
}),
bds.se.dialog = function() {
    function t() {
        o.hide(),
        $(".dialog").hide()
    }
    function e(t, e) {
        var n = $(window),
        o = (n.height() - t.outerHeight()) / 2,
        a = (n.width() - t.outerWidth()) / 2,
        i = n.scrollTop();
        i += e ? e: Math.max(o, 10),
        $curDialog = t,
        t.css({
            top: i,
            left: a
        })
    }
    function n(t, n) {
        e(t, n);
        var a = Math.max(document.body.scrollHeight, document.documentElement.clientHeight, document.body.clientHeight);
        o.height(a),
        t.show(),
        o.show()
    }
    var o = $(".dialog_bg"),
    a = "weiboShareDialog";
    return o.on("click",
    function() {
        return "block" !== $("." + a).css("display") && t(),
        !1
    }),
    $("body").on("click", ".dialog_close",
    function(e) {
        t(),
        e.preventDefault()
    }),
    {
        showDialog: n,
        hideDialog: t
    }
} (),
!
function() {
    function t(t) {
        function e() {
            o(),
            n(),
            v || (21 >= m ? v = 1 : m > 21 && 41 >= m ? v = 2 : m > 41 && 61 >= m ? v = 3 : m > 61 && 81 >= m && (v = 4)),
            _ = a()
        }
        function n() {
            var t = "";
            t += '<div class="textTips"><span class="year"></span><span class="number"></span></div>',
            t += '<div class="lineTips"></div>',
            $(t).appendTo(K),
            Z = K.find(".textTips"),
            X = K.find(".lineTips"),
            te = Z.find(".number"),
            ee = Z.find(".year"),
            X.css("background-color", Y),
            oe = parseInt(X.css("bottom"))
        }
        function o() {
            M.width = b,
            M.height = w,
            E.width = b,
            E.height = w,
            q.width = b,
            q.height = w,
            B.height = B.width = 2 * D,
            V.addClass("line_map_wrapper"),
            K.addClass("line_map_container"),
            V.parent().css("overflow", "visible"),
            $(M).css({
                width: b,
                height: w,
                "z-index": 80
            }).addClass("line_map_canvas"),
            $(E).css({
                width: b,
                height: w,
                "z-index": 99
            }).addClass("line_map_canvas"),
            $(q).css({
                width: b,
                height: w,
                "z-index": 90
            }).addClass("line_map_canvas"),
            ne.addClass("hoverCanvas"),
            ae = parseInt($(M).css("top"))
        }
        function a() {
            for (var t, e = 0,
            n = m - 1; n >= 0; n--) t = h[n].num,
            t > e && (e = t);
            return e
        }
        function i() {
            p(re)
        }
        function r() {
            var t, e, n, o, a, i = T / 2;
            K.on("mousemove",
            function(r) {
                clearTimeout(a),
                n = d(G),
                a = setTimeout(function() {
                    t = r.pageX || r.clientX + document.documentElement.scrollLeft,
                    e = r.pageY || r.clientY + document.documentElement.scrollTop,
                    t -= n.left - i,
                    e -= n.top - i,
                    o = f(t, e),
                    o && p(o)
                },
                10)
            })
        }
        function s(t, e) {
            H.beginPath(),
            H.arc(t, e, y, 0, 2 * Math.PI, 1),
            H.closePath(),
            H.fill(),
            H.beginPath(),
            H.arc(t, e, x, 0, 2 * Math.PI, 1),
            H.closePath(),
            H.lineWidth = C,
            H.fill(),
            H.stroke()
        }
        function c() {
            var t = 0,
            e = 0,
            n = 0,
            o = T / 2;
            for (J.strokeStyle = L, N.strokeStyle = "#fff", H.strokeStyle = Q, N.fillStyle = "red", H.fillStyle = "#fff", N.translate(o, o), H.translate(o, o), J.translate(o, o), N.beginPath(), J.beginPath(), N.moveTo(t, S - e); m > n; n += 1) e = S * (1 - h[n].num / _),
            ie.push([t, e]),
            0 !== e || re || (re = {
                x: t,
                y: e,
                number: h[n].num,
                year: h[n].year
            }),
            N.lineTo(t, e),
            0 === n ? J.moveTo(t, e) : J.lineTo(t, e),
            s(t, e),
            t += A;
            N.lineTo(t - A, S),
            J.stroke(),
            N.stroke(),
            l()
        }
        function l() {
            var t = !!document.createElement("canvas").getContext;
            if (t && R) {
                var e = document.createElement("img");
                e.src = R,
                e.onload = function() {
                    N.fillStyle = N.createPattern(e, "repeat"),
                    N.fill()
                }
            } else N.fillStyle = F,
            N.fill()
        }
        function u() {
            U.translate(D, D),
            U.fillStyle = z,
            U.beginPath(),
            U.arc(0, 0, D, 0, 2 * Math.PI, 1),
            U.closePath(),
            U.fill(),
            U.fillStyle = "#fff",
            U.beginPath(),
            U.arc(0, 0, j, 0, 2 * Math.PI, 1),
            U.closePath(),
            U.fill(),
            U.beginPath(),
            U.fillStyle = W,
            U.arc(0, 0, I, 0, 2 * Math.PI, 1),
            U.closePath(),
            U.fill()
        }
        function d(t) {
            for (var e = 0,
            n = 0; null != t;) e += t.offsetLeft,
            n += t.offsetTop,
            t = t.offsetParent;
            return {
                left: e,
                top: n
            }
        }
        function f(t) {
            for (var e, n, o, a = 0; m > a; a++) if (e = ie[a][0], n = ie[a][1], o = Math.abs(t - e), A / 2 > o) return {
                x: e,
                y: n,
                number: h[a].num,
                year: h[a].year
            }
        }
        function p(t) {
            te.text(t.number),
            ee.text(t.year + "年" + g);
            var e = Z.outerWidth(),
            n = (Z.outerHeight(), t.x + T / 2 + 2);
            n + e > b && (n = t.x - e + T / 2 - 2),
            Z.css({
                left: n,
                bottom: 5
            }),
            X.css({
                left: t.x + T / 2,
                height: S - t.y - oe - ae
            }),
            ne.css({
                left: t.x - D / 2,
                top: t.y - D / 2 + ae
            }),
            Z.show(),
            X.show(),
            ne.show()
        }
        var h = t.data,
        g = t.tiptext,
        m = h.length,
        v = t.dataGap || 0,
        _ = 0,
        b = t.canW || 740,
        w = t.canH || 110,
        y = 4,
        x = 2,
        C = 1,
        T = 2 * y,
        k = b - T,
        S = w - T,
        A = k / (m - 1),
        D = 10,
        j = 5,
        I = 3,
        P = t.config || {},
        O = t.canvas,
        M = O.bgCan,
        N = M.getContext("2d"),
        E = O.cirCan,
        H = E.getContext("2d"),
        q = O.routeCan,
        J = q.getContext("2d"),
        B = O.hoverCan,
        U = B.getContext("2d"),
        R = P.bgimg || "",
        F = P.bgColor || "#ffdec8",
        W = P.hoverCirColor || "#3388ff",
        z = P.hoverBgColor || "rgba(51, 136, 255,.3)",
        L = P.lineColor || "#ff6600",
        Q = P.cirColor || "#ff6600",
        Y = P.lineTipsColor || "#ffc096",
        G = t.container,
        K = $(G),
        V = $(t.wrapper),
        X = null,
        Z = null,
        te = null,
        ee = null,
        ne = $(B),
        oe = 0,
        ae = 0,
        ie = [],
        re = null;
        this.render = function() {
            e(),
            c(),
            u(),
            i(),
            r()
        }
    }
    A = window.A || {},
    A.ui = A.ui || {},
    A.ui.lineMap = function(e) {
        return new t(e)
    }
} (),
bds.se.effectPie = function() {
    function t() {
        if (pieMapAchData) {
            for (var t = {
                journal: "jour_piecanvas",
                conference: "conf_piecanvas",
                booktitle: "book_piecanvas",
                other: "other_piecanvas"
            },
            o = null, a = "", i = 0, r = pieMapAchDataType.length; r > i; i++) a = pieMapAchDataType[i],
            o = $("#" + t[a])[0],
            supportCanvas || A.ui.canvas.init(o),
            new n({
                pieCanvas: o,
                percent: pieMapAchData[a]
            });
            e()
        }
    }
    function e() {
        $(".pie_map_container").mouseenter(function() {
            clearTimeout(o),
            $(".pieBox").hide();
            var t = $(this),
            e = t.attr("data-type"),
            n = $(".effectmap_pie ." + e + "Box");
            if (n.length) {
                var a = $(".effectmap_pie"),
                i = a.outerHeight(),
                r = n.outerHeight(),
                s = t.offset().left - a.offset().left + t.outerWidth() + 6,
                c = (i - r) / 2;
                n.css({
                    top: c,
                    left: s
                }).show()
            }
        }).mouseleave(function() {
            var t = $(this),
            e = t.attr("data-type"),
            n = $(".effectmap_pie ." + e + "Box");
            o = setTimeout(function() {
                n.hide()
            },
            100)
        })
    }
    function n(t) {
        function e(t, e, n, o, i) {
            t.beginPath(),
            t.moveTo(a, a),
            t.fillStyle = i,
            t.arc(a, a, e, n, o, !1),
            t.fill(),
            t.closePath()
        }
        var n = t.pieCanvas,
        o = n.getContext("2d"),
        a = 50,
        i = 44,
        r = "#f60",
        s = "#dfe6ee",
        c = t.percent;
        if (e(o, a, 0, 2 * Math.PI, s), c > 0) {
            var l = -Math.PI / 2,
            u = 2 * Math.PI * c,
            d = u + l;
            e(o, a, l, d, r)
        }
        e(o, i, 0, 2 * Math.PI, "#fff")
    }
    var o = null;
    return {
        init: t
    }
} ();
var bds = bds || {};
bds.se = bds.se || {},
bds.se.initEffectMap = function() {
    function t() {
        var t = document.getElementById("cited_bgCanvas"),
        e = document.getElementById("cited_circleCanvas"),
        n = document.getElementById("cited_routeCanvas"),
        o = document.getElementById("cited_hoverCanvas"),
        a = document.getElementById("cited_map_wrapper"),
        i = document.getElementById("cited_map_container");
        if (t && lineMapCitedData) {
            supportCanvas || (A.ui.canvas.init(t), A.ui.canvas.init(e), A.ui.canvas.init(n), A.ui.canvas.init(o));
            var r = A.ui.lineMap({
                data: lineMapCitedData,
                tiptext: "被引量",
                container: i,
                wrapper: a,
                canW: 340,
                canH: 110,
                canvas: {
                    bgCan: t,
                    cirCan: e,
                    routeCan: n,
                    hoverCan: o
                },
                config: {
                    bgimg: "http://s1.bdstatic.com/r/www/cache/scholar/static/ui/img/line_mapbg_80bf122.png"
                }
            });
            r.render()
        }
    }
    function e() {
        var t = document.getElementById("ach_bgCanvas"),
        e = document.getElementById("ach_circleCanvas"),
        n = document.getElementById("ach_routeCanvas"),
        o = document.getElementById("ach_hoverCanvas"),
        a = document.getElementById("ach_map_wrapper"),
        i = document.getElementById("ach_map_container");
        if (t && lineMapAchData) {
            supportCanvas || (A.ui.canvas.init(t), A.ui.canvas.init(e), A.ui.canvas.init(n), A.ui.canvas.init(o));
            var r = A.ui.lineMap({
                data: lineMapAchData,
                tiptext: "成果数",
                container: i,
                wrapper: a,
                canW: 340,
                canH: 110,
                canvas: {
                    bgCan: t,
                    cirCan: e,
                    routeCan: n,
                    hoverCan: o
                },
                config: {
                    bgimg: "http://s1.bdstatic.com/r/www/cache/scholar/static/ui/img/line_mapbg_80bf122.png"
                }
            });
            r.render()
        }
    }
    function n() {
        e(),
        t(),
        bds.se.effectPie.init()
    }
    return {
        init: n
    }
} (),
bds.se.initEffectMap.init();
var bds = bds || {};
bds.se = bds.se || {},
bds.se.initCoopeMap = function() {
    function t() {
        var t = document.getElementById("coRelMap");
        if (t) {
            supportCanvas || A.ui.canvas.init(t);
            var e = 1 * $("#co_rel_map").attr("data-count"),
            n = new RelMap({
                canvas: t,
                count: e,
                relAuClass: "co_relmap_person"
            });
            n.render()
        }
    }
    function e() {
        t()
    }
    return {
        init: e
    }
} (),
function() {
    $(".co_author_more").on("click",
    function(t) {
        $("#co_rel_map").length ? bds.se.dialog.showDialog($("#co_rel_map")) : $.ajax({
            url: "/usercenter/data/author",
            type: "POST",
            dataType: "html",
            data: {
                cmd: "show_co_affiliate",
                entity_id: bds.comm.entity_id
            }
        }).done(function(t) {
            $(t).appendTo($("body")),
            bds.se.dialog.showDialog($("#co_rel_map")),
            bds.se.initCoopeMap.init()
        }).fail(function() {
            bds.util.dialogTips( - 101, "请求失败")
        }),
        t.preventDefault()
    })
} (),
bds.se.authorMerge = function() {
    function t() {
        var t = ['<div class="author_merge_dialog dialog">', '    <a href="javascript:;" class="c-icon-close-hover close_icon dialog_close"><i class="c-icon c-icon-close"></i></a>', '    <div class="dialog_content">', "        <h3>合并学者提示</h3>", '        <p class="">检测到您已经认证了<a href="/homepage/u/' + bds.comm.mergeAuthorId + '" target="_blank">' + bds.comm.mergeAuthor + "</a>学者主页，是否要认证当前主页并将二者合并？</p>", '        <div class="btn_wr">', '            <span class="submit_btn bluebtn btn">合并</span>', '            <span class="btn dialog_close">取消</span>', "        </div>", "    </div>", '    <div class="errortips"></div>', "</div>"].join("");
        $(t).appendTo($("body")),
        bds.se.dialog.showDialog($(".author_merge_dialog"))
    }
    function e() {
        var t = ["<h3>申请审核中</h3>", '<p class="">您的认证申请已经提交审核，审核结果将在3个工作日内反馈到邮箱，注意查收。</p>', '<div class="btn_wr">', '   <span class="btn bluebtn dialog_close">确认</span>', "</div>"].join("");
        return t
    }
    function n() {
        $(".author_merge_dialog .submit_btn").on("click",
        function() {
            $.ajax({
                url: "/usercenter/data/author",
                type: "POST",
                dataType: "json",
                data: {
                    cmd: "author_merge",
                    entity_id: bds.comm.entity_id
                }
            }).done(function(t) {
                var n = $(".author_merge_dialog");
                if (200 == t.status) {
                    var o = e();
                    n.find(".dialog_content").html(o)
                } else n.find(".errortips").html("请求失败了:(").show()
            }).fail(function() {
                $dialog.find(".errortips").html("网络异常，请求失败了:(").show()
            })
        })
    }
    function o() {
        var e = $(".author_merge_dialog");
        return e.length ? (e.find(".errortips").hide(), void bds.se.dialog.showDialog(e)) : (t(), void n())
    }
    return {
        show: o
    }
} (),
bds.se.indexArticle = function() {
    function t() {
        return $(".in_content_result_wr .res-page-number-now").attr("data-num")
    }
    function e(t) {
        t = t || {};
        var e, o = $(".in_sort_sel").attr("data-sort") || "sc_time",
        a = {
            cmd: "academic_paper",
            entity_id: bds.comm.entity_id,
            bsToken: bds.comm.bsToken,
            sc_sort: o
        };
        $(".filter_sel_default").each(function() {
            e = $(this),
            a[e.attr("data-target")] = e.attr("data-id")
        }),
        t.pagenum && (a.curPageNum = t.pagenum);
        var i = t.backTop || 0;
        $.ajax({
            url: "/usercenter/data/author",
            type: "post",
            dataType: "html",
            data: a,
            success: function(e) {
                n(e, i),
                t.cbSuccess && t.cbSuccess()
            },
            error: function() {
                t.cbError && t.cbError()
            }
        })
    }
    function n(t, e) {
        if (i.html(t), e) {
            var n = $("#articlelist_wr").offset().top - 50;
            $(window).scrollTop(n)
        }
    }
    var o = $(".in_content_filter"),
    a = $(".filter_list"),
    i = ($(".year_sel_default"), $(".field_sel_default"), $(".in_content_result_wr")),
    r = null;
    return o.on("mouseover",
    function(t) {
        r && clearTimeout(r),
        $(this).siblings(".in_content_filter").removeClass("content_filter_hover"),
        $(this).addClass("content_filter_hover"),
        bds.se.filterListScroll.render(),
        t.preventDefault()
    }).on("mouseout",
    function(t) {
        r && clearTimeout(r),
        r = setTimeout(function() {
            o.removeClass("content_filter_hover")
        },
        300),
        t.preventDefault()
    }),
    a.find("li").on("click",
    function(t) {
        var n = $(this),
        o = "",
        a = "";
        if (!n.hasClass("select")) {
            n.siblings(".select").removeClass("select"),
            n.addClass("select"),
            o = n.text(),
            a = n.attr("data-id") || "";
            var i = n.parents(".in_content_filter").find(".filter_sel_default");
            i.attr("data-id", a).find("span").text(o),
            $(".content_filter_hover").removeClass("content_filter_hover"),
            e()
        }
        t.preventDefault()
    }),
    $(".in_content_sort").on("click", ".in_content_sort_link",
    function(t) {
        var n = $(this);
        n.hasClass("in_sort_sel") || (n.siblings(".in_sort_sel").removeClass("in_sort_sel"), n.addClass("in_sort_sel"), e()),
        t.preventDefault()
    }),
    $(".in_content_result_wr").on("click", ".res-page-number,.res-page-pre,.res-page-next",
    function(t) {
        var n = $(this).attr("data-num");
        e({
            pagenum: n,
            backTop: 1
        }),
        t.preventDefault()
    }),
    $(".in_content_rtop_edit .add_article_btn").on("click",
    function(t) {
        bds.se.getArticleData.getAticlePage(),
        t.preventDefault()
    }),
    {
        request: e,
        getCurPage: t
    }
} (),
bds.se.filterListScroll = A.ui.scrollbarv({
    content: $(".in_content_filter .scrollbar_wrapper")[0]
});
var bds = window.bds || {};
bds.se = bds.se || {},
bds.se.reqCollect = function() {
    function t(t, n) {
        i = $.extend(i, t),
        e(n.url),
        o()
    }
    function e(t) {
        $.ajax({
            url: "/usercenter/data/collect?cmd=add_paper",
            dataType: "jsonp",
            data: {
                paper_url: t
            },
            timeout: 1500,
            success: function(t) {
                200 == t.status ? n(t.data.id) : a()
            },
            complete: function(t, e) {
                "success" !== e && a()
            }
        })
    }
    function n(t) {
        var e = i.coltBtnDom;
        setTimeout(function() {
            t && (i.coltTextDom.html("已收藏"), e.find(".c-icon").removeClass("c-icon-heart").addClass("c-icon-heart-org"), e.addClass(i.sucClass), e.attr({
                href: i.jumpPage + "&paper_id=" + t
            }))
        },
        150)
    }
    function o() {
        var t = "",
        e = navigator.userAgent,
        n = /MSIE (\d+).*/,
        o = e.match(n);
        t = o && parseInt(o[1]) < 9 ? "收藏中...": ['<span class="spinner">', '<span class="bounce1"></span>', '<span class="bounce2"></span>', '<span class="bounce3"></span>', "</span>"].join(""),
        i.coltTextDom.html(t)
    }
    function a() {
        setTimeout(function() {
            i.coltTextDom.html("收藏失败")
        },
        150)
    }
    var i = {
        coltBtnDom: null,
        coltTextDom: null,
        jumpPage: "/usercenter?tab=collect",
        sucClass: "collected"
    };
    return t
} (),
$(".in_content_result_wr").on("click", ".res_col",
function(t) {
    var e = $(this),
    n = e.parents(".res_tool").attr("data-link");
    if (!e.hasClass("collected") && !e.find(".spinner").length) {
        if (!bds.comm.user) return bds.se.login.open(),
        void t.preventDefault();
        var o = {
            url: n
        };
        bds.se.reqCollect({
            coltBtnDom: e,
            coltTextDom: e.find(".col_text")
        },
        o),
        t.preventDefault()
    }
}),
bds.se.getQuote = function() {
    function t(t) {
        $.ajax({
            url: "http://s1.bdstatic.com/r/www/cache/mid/static/xueshu/js/quote.js",
            dataType: "script",
            success: function() {
                t && t()
            }
        })
    }
    function e(e) {
        bds && bds.se && bds.se.quote ? bds.se.quote.init(e) : t(function() {
            bds.se.quote.init(e)
        })
    }
    function n(t) {
        bds && bds.se && bds.se.quote && bds.se.quote.show(t)
    }
    function o() {
        bds && bds.se && bds.se.quote && bds.se.quote.hide()
    }
    return t(),
    {
        init: e,
        show: n,
        hide: o
    }
} (),
bds.se.getArticleData = function() {
    function t() {
        var t = $("#add_articlepage");
        return t.length ? (t.show(), $("#articlelist_container").hide(), $(".manualcontent .search_article_content").show(), void $(".manualcontent .handinput_content").hide()) : void a({
            data: {
                cmd: "recommend_paper",
                init: 1
            },
            success: function(t) {
                $("#articlelist_container").hide(),
                $("#add_articlepage").length || $(t).appendTo($("#articlelist_wr")),
                bds.se.articleEvent.init()
            },
            error: function() {
                bds.util.dialogTips(500, "请求失败")
            }
        })
    }
    function e(t, e) {
        var n = $("#add_articlepage .recmarticle_" + t + "_wr"),
        o = {
            group: 1,
            single: 2
        };
        n.html(s).show(),
        a({
            data: {
                cmd: "recommend_paper",
                curPageNum: e.curPageNum || 1,
                type: o[t]
            },
            success: function(t) {
                n.html(t)
            },
            error: function() {
                n.html(i)
            }
        })
    }
    function n(t) {
        var e = $("#add_articlepage .noneed_tip"),
        n = $("#add_articlepage .search_article_reswr");
        n.html(s),
        e.hide(),
        a({
            data: {
                cmd: "search_paper",
                wd: t.title
            },
            success: function(t) {
                n.html(t),
                e.show()
            },
            error: function() {
                n.html(i),
                e.show()
            }
        })
    }
    function o(t) {
        var e = $(".grmore_content_dialog");
        if (!e.length) {
            var n = ['<div class="grmore_content_dialog dialog">', '<span class="closeicon dialog_close"><i class="c-icon c-icon-close"></i></span>', '<div class="article_wr"></div>', "</div>"].join("");
            $(n).appendTo($("#add_articlepage")),
            e = $(".grmore_content_dialog")
        }
        t.isPageTurn || (e.find(".article_wr").html(s), bds.se.dialog.showDialog(e, 100));
        var o = t;
        o.cmd = "paper_group_list",
        a({
            data: o,
            success: function(t) {
                e.find(".article_wr").html(t)
            },
            error: function() {
                e.find(".article_wr").html(i)
            }
        })
    }
    function a(t) {
        var e = t.data || {};
        e.entity_id = bds.comm.entity_id,
        e.bsToken = bds.comm.bsToken,
        $.ajax({
            url: "/usercenter/data/author",
            type: "post",
            dataType: "json",
            data: t.data,
            timeout: 2e3,
            success: function(e) {
                var n = e.htmldata;
                e.status && -102 == e.status && (n = r),
                t.success && t.success(n)
            },
            complete: function(e, n) {
                "success" !== n && t.error && t.error()
            }
        })
    }
    var i = '<div class="errortip">网络异常，获取数据失败</div>',
    r = '<div class="errortip">抱歉，您已退出登陆，<a href="javascript:;" class="loginbtn">重新登陆</a></div>',
    s = "",
    c = navigator.userAgent,
    l = /MSIE (\d+).*/,
    u = c.match(l);
    return s = u && parseInt(u[1]) < 9 ? '<div class="loading">数据加载中...</div>': ['<div class="loading">数据加载中&nbsp;', '<span class="spinner">', '<span class="bounce1"></span>', '<span class="bounce2"></span>', '<span class="bounce3"></span>', "</span>", "</div>"].join(""),
    {
        getAticle: function(t, a) {
            switch (t) {
            case "search":
                n(a);
                break;
            case "grmore":
                o(a);
                break;
            case "single":
                e("single", a);
                break;
            case "group":
                e("group", a)
            }
        },
        getAticlePage: t
    }
} (),
bds.se.editArticle = function() {
    function t(t) {
        var e = t.data || {};
        e.entity_id = bds.comm.entity_id,
        e.bsToken = bds.comm.bsToken,
        $.ajax({
            url: "/usercenter/data/author",
            type: "get",
            dataType: "json",
            data: t.data,
            timeout: 1500,
            success: function(e) {
                t.success && t.success(e)
            },
            complete: function(e, n) {
                "success" !== n && t.error && t.error()
            }
        })
    }
    var e = 0;
    return {
        addArticle: function(e, n) {
            var o = e,
            a = n;
            a.cmd = "add_paper",
            t({
                data: a,
                success: function(t) {
                    if (200 === t.status) o.attr("data-add", "1"),
                    o.find(".c-icon").removeClass("c-icon-add-cricle").addClass("c-icon-ok-blue");
                    else {
                        var e = -102 === t.status ? "操作失败，您未登录": "操作失败";
                        bds.util.dialogTips(t.status, e)
                    }
                },
                error: function() {
                    bds.util.dialogTips(500, "操作失败，请求超时")
                }
            })
        },
        addArticleAll: function(e) {
            var n = e;
            n.cmd = "add_paper",
            t({
                data: n,
                success: function(t) {
                    if (bds.se.dialog.hideDialog($(".grmore_content_dialog")), 200 === t.status) bds.util.dialogTips(t.status, "操作成功");
                    else {
                        var e = -102 === t.status ? "操作失败，您未登录": "操作失败";
                        bds.util.dialogTips(t.status, e)
                    }
                },
                error: function() {
                    bds.se.dialog.hideDialog($(".grmore_content_dialog")),
                    bds.util.dialogTips(500, "操作失败，请求超时")
                }
            })
        },
        addArticleHand: function(n) {
            if (!e) {
                e = 1;
                var o = n;
                o.source = 2,
                o.cmd = "add_paper";
                var a = $(".handinput_content .resulttips");
                a.text("请求中，请稍后...").show(),
                t({
                    data: o,
                    success: function(t) {
                        if (200 === t.status) bds.util.dialogTips(t.status, "添加成功"),
                        a.hide();
                        else {
                            var n = -102 === t.status ? "添加失败，您未登录": "请求错误，添加失败";
                            a.text(n).show()
                        }
                        e = 0
                    },
                    error: function() {
                        e = 0,
                        a.text("网络异常，添加失败").show()
                    }
                })
            }
        },
        delArticle: function(e) {
            var n = {
                cmd: "delete_paper",
                sc_longsign: e.sc_longsign,
                source: e.source
            };
            t({
                data: n,
                success: function(t) {
                    if (200 === t.status) e.delBtn.parents(".result").remove(),
                    bds.util.dialogTips(t.status, "操作成功");
                    else {
                        var n = -102 === t.status ? "操作失败，您未登录": "操作失败";
                        bds.util.dialogTips(t.status, n)
                    }
                },
                error: function() {
                    bds.util.dialogTips(500, "请求超时")
                }
            })
        }
    }
} (),
bds.se.editAuthor = function() {
    function t(t) {
        var e = /^[a-zA-Z]\w{5,17}$/;
        return e.test(t) ? !0 : (h.hide(), g.html('<i class="c-icon c-icon-fail-s"></i>域名格式不正确').addClass("error").show(), !1)
    }
    function e(t) {
        var e = /^[0-9]+\/[0-9]+$/;
        return e.test(t)
    }
    function n(t, e) {
        for (var n = e.find(".keyword_item"), o = 0, a = n.length; a > o; o++) if ($(n[o]).text() === t) return ! 1;
        return ! 0
    }
    function o(t) {
        var e = t.val(),
        o = "",
        i = t.parents(".infoitem"),
        r = i.find(".ipterrortip"),
        s = t.attr("name"),
        c = null,
        l = i.find(".affi_domain_keyword_list"),
        u = l.find(".keyword_item").length,
        d = 1 * l.attr("data-count"),
        f = t.attr("placeholder"),
        p = "",
        h = "";
        if ("affiliate" === s ? (p = "机构最多允许添加5个哦~", h = "该机构已经添加过了") : (p = "领域最多允许添加10个哦~", h = "该领域已经添加过了"), u >= d) return void r.text(p).show();
        if (r.hide(), e.length && e !== f) {
            if (!n(e, l)) return void r.text(h).show();
            o = a(e),
            c = $(o),
            c.appendTo(l).hide(),
            c.fadeIn(),
            t.val("")
        }
        bds.se.editAuthorScroll.render()
    }
    function a(t) {
        var e = "";
        return e += '<a href="javascript:;" class="keyword_item">' + t,
        e += '<i class="c-icon c-icon-label-del"></i>',
        e += "</a>"
    }
    function i(t) {
        var e = "";
        switch (t) {
        case - 101 : e = "请求数据错误";
            break;
        case - 102 : e = "您已退出登陆";
            break;
        case - 103 : e = "服务器操作异常";
            break;
        case - 105 : e = "操作失败";
            break;
        case - 811 : e = "域名修改失败";
            break;
        default:
            e = "操作失败"
        }
        return e
    }
    function r(t) {
        u.text("请求中，请耐心等待...").show(),
        $.ajax({
            url: "/usercenter/data/author",
            type: "POST",
            dataType: "json",
            data: t,
            success: function(t) {
                if (200 === t.status) {
                    if (t.upAlias) return void(window.location.href = "http://xueshu.baidu.com/homepage/u/" + bds.comm.entity_id);
                    t.htmldata && ($("#author_intro_wr").html(t.htmldata), bds.se.auhtorRecordScroll = A.ui.scrollbarv({
                        content: $("#author_intro_wr .person_record_scroll")[0]
                    }), bds.se.authorProfile.init()),
                    bds.se.dialog.hideDialog(),
                    bds.util.dialogTips(200, "操作成功")
                } else {
                    var e = i(t.status);
                    u.text("抱歉，" + e)
                }
            },
            error: function() {
                u.text("抱歉，网络异常，请稍后重试")
            }
        })
    }
    function s() {
        u.hide(),
        $(".edit_authorinfo_page .ipterrortip").hide(),
        bds.se.dialog.showDialog(l),
        bds.se.editAuthorScroll ? bds.se.editAuthorScroll.render() : bds.se.editAuthorScroll = A.ui.scrollbarv({
            content: $(".edit_authorinfo_scroll")[0]
        })
    }
    var c = $(".affi_domain_input"),
    l = $(".edit_authorinfo_page"),
    u = l.find(".resulttips"),
    d = $(".affi_domain_add_btn"),
    f = l.find(".addnew_record");
    c.on("keydown",
    function(t) {
        13 == t.keyCode && o($(this))
    }),
    d.on("click",
    function(t) {
        var e = $(this).siblings(".affi_domain_input");
        o(e),
        t.preventDefault()
    }),
    l.on("click", ".keyword_item",
    function(t) {
        var e = $(this);
        e.siblings(".keyword_item").length,
        e.remove(),
        t.preventDefault()
    }),
    f.on("click",
    function(t) {
        var e = ['<span class="record_item">', '<input type="text" name="year" class="inputtext record_year_ipt" placeholder="年/月" id="" value="" maxlength="">', '<span class="record_split">-</span>', '<input type="text" name="record" class="inputtext record_text_ipt" placeholder="详细履历 (请按照时间倒序填写)" id="" value="" maxlength="150">', "</span>"].join("");
        $(e).insertBefore(f),
        t.preventDefault()
    });
    var p = 0,
    h = $(".uqdomain_patterntips"),
    g = $(".uqdomain_restips"),
    m = l.find(".uqdomain_ipt");
    return m.on("focus",
    function() {
        p = 0,
        h.show(),
        g.hide()
    }).on("blur",
    function() {
        var e = m.val();
        if (e.length && !p) {
            if (p = 1, !t(e)) return;
            $.ajax({
                url: "/usercenter/data/author",
                type: "POST",
                dataType: "json",
                data: {
                    cmd: "check_alias",
                    alias: e,
                    entity_id: bds.comm.entity_id
                }

            }).done(function(t) {
                200 === t.status ? e !== bds.comm.alias && (h.hide(), g.html('<i class="c-icon c-icon-ok-green"></i>该域名可以使用!').removeClass("error").show()) : (h.hide(), g.html('<i class="c-icon c-icon-fail-s"></i>该域名已被使用').addClass("error").show())
            })
        }
    }),
    l.find(".subbtn").on("click",
    function(n) {
        var o = l.find(".affiliate_list .keyword_item"),
        a = l.find(".domain_list .keyword_item"),
        i = l.find(".record_listwr .record_item"),
        s = [],
        c = [],
        d = [],
        f = l.attr("data-entityid");
        if ($profile = $(".profile_textarea"), profileText = $profile.val(), data = null, o.each(function() {
            c.push($(this).text())
        }), !c.length) return u.text("机构不能为空").show(),
        !1;
        if (a.each(function() {
            s.push($(this).text())
        }), !s.length) return u.text("领域不能为空").show(),
        !1;
        var p = m.val();
        if (p.length && !t(p)) return ! 1;
        for (var h, g, v, _ = "",
        b = "",
        w = 0,
        y = i.length; y > w; w++) if (h = $(i[w]), g = h.find(".record_year_ipt"), _ = g.val(), v = h.find(".record_text_ipt"), b = v.val(), _ === g.attr("placeholder") && (_ = ""), b === v.attr("placeholder") && (b = ""), _ && b) {
            if (!e(_)) return g.focus(),
            u.text("年份格式不正确，请重新填写").show(),
            !1;
            d.push({
                year: _,
                record: b
            })
        }
        data = {
            cmd: "update_introduce",
            entity_id: f,
            research_domain: JSON.stringify(s),
            affiliate: JSON.stringify(c),
            profile: profileText,
            alias: p,
            personal_record: JSON.stringify(d)
        },
        r(data),
        n.preventDefault()
    }),
    {
        showPage: s
    }
} (),
bds.se.articleEvent = function() {
    function t(t) {
        t.siblings("." + i).removeClass(i),
        t.addClass(i)
    }
    function e(t, e, n) {
        if (!e.length || e === n) return ! 1;
        if ("sc_year" === t) {
            var o = new Date,
            o = o.getFullYear(),
            a = /^[1,2][0-9]{3}$/;
            return e.match(a) && o >= 1 * e ? !0 : !1
        }
        return ! 0
    }
    function n() {
        var t, n = $(".handinput_content"),
        o = n.find(".resulttips"),
        a = "",
        i = "",
        r = "",
        s = {},
        c = n.find(".inputtext"),
        l = n.find(".typeitem.select");
        if (!l.length) return ! 1;
        s.sc_type = l.find(".inputradio").val();
        for (var u = 0,
        d = c.length; d > u; u++) {
            if (t = $(c[u]), i = t.attr("name"), a = t.val(), r = t.attr("placeholder"), "sc_abstract" !== i && !e(i, a, r)) return t.focus(),
            o.text("请检查输入是否正确").show(),
            !1;
            a !== r && (s[i] = a)
        }
        bds.se.editArticle.addArticleHand(s)
    }
    function o() {
        function t() {
            return "placeholder" in document.createElement("input")
        }
        t() || $("#add_articlepage input[placeholder]").focus(function() {
            var t = $(this);
            t.val() == t.attr("placeholder") && (t.val(""), t.removeClass("placeholder"))
        }).blur(function() {
            var t = $(this); ("" == t.val() || t.val() == t.attr("placeholder")) && (t.addClass("placeholder"), t.val(t.attr("placeholder")))
        }).blur(),
        $("#add_articlepage .handinput_form").on("submit",
        function() {
            return n(),
            !1
        }),
        $("#add_articlepage .search_article_form").on("submit",
        function() {
            var t = $(".search_art_input"),
            e = t.attr("placeholder"),
            n = t.val();
            return n.length && e !== n ? (bds.se.getArticleData.getAticle("search", {
                title: n
            }), !1) : (t.focus(), !1)
        })
    }
    var a = $("#articlelist_wr"),
    i = "tabitemsel";
    return a.on("click", "#add_articlepage .toptabitem",
    function(e) {
        var n = $(this),
        o = n.attr("data-target");
        if (n.hasClass(i)) return ! 1;
        t(n);
        var a = $(".manualcontent"),
        r = $(".recmcontent");
        "recm" === o ? (r.show(), a.hide()) : (r.hide(), a.show(), $(".search_article_content").show(), $(".handinput_content").hide()),
        e.preventDefault()
    }),
    a.on("click", "#add_articlepage .subtabitem",
    function(e) {
        var n = $(this),
        o = n.attr("data-type"),
        a = "single" === o ? "group": "single";
        if (n.hasClass(i)) return ! 1;
        t(n);
        var r = $("#add_articlepage .recmarticle_" + o + "_wr"),
        s = r.find(".article_" + o + "_res");
        r.siblings(".recmarticle_" + a + "_wr").hide(),
        s.length ? r.show() : bds.se.getArticleData.getAticle(o, {}),
        e.preventDefault()
    }),
    a.on("click", ".article_group_res .pagenumber",
    function(t) {
        var e = $(this),
        n = e.attr("data-num");
        bds.se.getArticleData.getAticle("group", {
            curPageNum: n
        }),
        t.preventDefault()
    }),
    a.on("click", ".article_single_res .pagenumber",
    function(t) {
        var e = $(this),
        n = e.attr("data-num");
        bds.se.getArticleData.getAticle("single", {
            curPageNum: n
        }),
        t.preventDefault()
    }),
    a.on("click", ".article_dialog_res .pagenumber",
    function(t) {
        var e = $(".article_dialog_res .headtitle"),
        n = $(this).attr("data-num");
        bds.se.getArticleData.getAticle("grmore", {
            name: e.attr("data-name"),
            count: e.attr("data-count"),
            alternative_entity_id: e.attr("data-entityid"),
            curPageNum: n,
            isPageTurn: 1
        }),
        t.preventDefault()
    }),
    a.on("click", "#add_articlepage .grmore",
    function(t) {
        var e = $(this).parents(".groupitem");
        bds.se.getArticleData.getAticle("grmore", {
            name: e.attr("data-name"),
            count: e.attr("data-count"),
            alternative_entity_id: e.attr("data-entityid")
        }),
        t.preventDefault()
    }),
    a.on("click", ".grmore_dialog_addall",
    function(t) {
        var e = ($(this), $(".article_dialog_res .headtitle")),
        n = {
            source: "1",
            alternative_entity_id: e.attr("data-entityid")
        };
        bds.se.editArticle.addArticleAll(n),
        t.preventDefault()
    }),
    a.on("click", ".res_addarticle_btn",
    function(t) {
        var e = $(this),
        n = e.attr("data-type"),
        o = e.attr("data-add"),
        a = e.parents(".article_reslist_wr").attr("data-source") || "1",
        i = {
            source: a
        };
        if ("1" === o) return ! 1;
        if ("group" === n) {
            var r = e.parents(".groupitem");
            i.alternative_entity_id = r.attr("data-entityid")
        } else i.alternative_entity_id = e.attr("data-entityid"),
        i.sc_longsign = e.attr("data-longsign");
        "3" === a && (i.url = e.parents(".article_item").find(".reqdata").attr("data-url")),
        bds.se.editArticle.addArticle(e, i),
        t.preventDefault()
    }),
    a.on("click", ".res_del_btn",
    function(t) {
        var e = $(this);
        bds.se.editArticle.delArticle({
            delBtn: e,
            sc_longsign: e.parents(".result").find(".reqdata").attr("data-longsign"),
            source: e.attr("data-source")
        }),
        t.preventDefault()
    }),
    a.on("click", "#add_articlepage .handinput_btn",
    function(t) {
        $(".search_article_content").hide(),
        $(".handinput_content").show(),
        $(".handinput_content .resulttips").hide(),
        $(window).scrollTop(0),
        t.preventDefault()
    }),
    a.on("click", "#add_articlepage .goback",
    function(t) {
        var e = bds.se.indexArticle.getCurPage();
        bds.se.indexArticle.request({
            pagenum: e,
            cbSuccess: function() {
                $("#articlelist_container").show(),
                $("#add_articlepage").hide()
            },
            cbError: function() {
                $("#articlelist_container").show(),
                $("#add_articlepage").hide()
            }
        }),
        t.preventDefault()
    }),
    a.on("click", ".handinput_form .typeitem",
    function(t) {
        var e = $(this);
        return e.hasClass("select") ? !1 : (e.siblings(".select").removeClass("select"), e.addClass("select"), void t.preventDefault())
    }),
    {
        init: o
    }
} (),
bds.se.authorProfile = function() {
    function t() {
        var t = $(".author_profile_dialog"),
        e = a.text();
        if (t.length) return t.find(".profiletext").html(e),
        void bds.se.dialog.showDialog(t);
        var n = ['<div class="author_profile_dialog dialog">', '<a href="javascript:" class="c-icon-close-hover closeicon dialog_close">', '<i class="c-icon c-icon-close"></i>', "</a>", "<h3>简介</h3>", '<div class="profiletext">' + e + "</div>", "</div>"].join("");
        $(n).appendTo($("body")),
        bds.se.dialog.showDialog($(".author_profile_dialog"))
    }
    function e() {
        o = $(".person_profile_wr"),
        a = o.find(".person_profile"),
        i = o.find(".profile_more"),
        a.height() > n && i.show(),
        i.on("click",
        function(e) {
            t(),
            e.preventDefault()
        })
    }
    var n = 75,
    o = null,
    a = null,
    i = null;
    return {
        init: e
    }
} (),
bds.se.authorProfile.init(),
function() {
    $("#author_intro_wr").on("click", ".p_editinfo_btn",
    function(t) {
        bds.se.editAuthor.showPage(),
        t.preventDefault()
    }),
    $("#author_intro_wr").on("click", ".person_authen",
    function(t) {
        bds.comm.uid || (bds.se.login.open(), t.preventDefault()),
        bds.comm.mergeAuthorId && (bds.se.authorMerge.show(), t.preventDefault())
    }),
    $("body").on("click", ".loginbtn",
    function(t) {
        bds.se.login.open(),
        t.preventDefault()
    })
} (),
bds.se.auhtorRecordScroll = A.ui.scrollbarv({
    content: $("#author_intro_wr .person_record_scroll")[0]
}),
function() {
    function t() {
        return "placeholder" in document.createElement("input")
    }
    t() || $("input[placeholder]").focus(function() {
        var t = $(this);
        t.val() == t.attr("placeholder") && (t.val(""), t.removeClass("placeholder"))
    }).blur(function() {
        var t = $(this); ("" == t.val() || t.val() == t.attr("placeholder")) && (t.addClass("placeholder"), t.val(t.attr("placeholder")))
    }).blur()
} (),
bds.se.getQuote.init({
    eventBtnClass: ".res_q",
    eventFn: function(t) {
        var e = t.attr("data-link"),
        n = t.attr("data-sign");
        bds.se.getQuote.show({
            sign: n,
            url: decodeURIComponent(e)
        })
    }
}),
!
function() {
    if ("1" === bds.comm.showShare) {
        var t = {
            bdText: "#我的学术新征途# 我已在@百度学术 认证了我的主页，从此科研更顺利~",
            bdPic: "http://s1.bdstatic.com/r/www/cache/scholar/static/homepage/img/share_4086a05.png",
            bdUrl: window.location.href.split("?")[0]
        },
        e = "http://service.weibo.com/share/share.php?url=" + encodeURIComponent(t.bdUrl);
        e += "&title=" + encodeURIComponent(t.bdText),
        e += "&pic=" + encodeURIComponent(t.bdPic),
        e += "&appkey=1343713053&searchPic=true";
        var n = ["<div class=\"weiboShareDialog dialog LOG_WR\" data-log=\"{'actblock':'homepageshare'}\">", '<a href="javascript:;" class="dialog_close closeicon"><i class="c-icon c-icon-close-w"></i></a>', "<h3>恭喜你！已认证成功！</h3>", '<div class="maintext">', "<h4>百度学术点匠令</h4>", "<p>分享“我的主页”，参与微话题讨论，赢取科研奖金</p>", "</div>", '<div class="button_wr">', '<a href="' + e + '" target="_blank" class="share_btn"  data-log="{\'type\':\'sharebtn\'}">去分享</a>', '<a href="/u/academicpro" target="_blank" class="detail_btn"  data-log="{\'type\':\'sharelink\'}">活动详情</a>', "</div>", "</div>"].join("");
        $(n).appendTo($("body")),
        bds.se.dialog.showDialog($(".weiboShareDialog"))
    }
} (),
function() {
    return
} ();