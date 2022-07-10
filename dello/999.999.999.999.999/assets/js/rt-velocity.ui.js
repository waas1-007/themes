! function (a) {
 "use strict";
 "function" == typeof require && "object" == typeof exports ? module.exports = a() : "function" == typeof define && define.amd ? define(["velocity"], a) : a()
}(function () {
 "use strict";
 return function (a, b, c, d) {
  var e = a.Velocity;
  if (!e || !e.Utilities) return void(b.console && console.log("Velocity UI Pack: Velocity must be loaded first. Aborting."));
  var f = e.Utilities,
   g = e.version,
   h = {
    major: 1,
    minor: 1,
    patch: 0
   };
  if (function (a, b) {
    var c = [];
    return !(!a || !b) && (f.each([a, b], function (a, b) {
     var d = [];
     f.each(b, function (a, b) {
      for (; b.toString().length < 5;) b = "0" + b;
      d.push(b)
     }), c.push(d.join(""))
    }), parseFloat(c[0]) > parseFloat(c[1]))
   }(h, g)) {
   var i = "Velocity UI Pack: You need to update Velocity (velocity.js) to a newer version.";
   throw alert(i), new Error(i)
  }
  e.RegisterEffect = e.RegisterUI = function (a, b) {
   function c(a, b, c, d) {
    var g, h = 0;
    f.each(a.nodeType ? [a] : a, function (a, b) {
     d && (c += a * d), g = b.parentNode;
     var i = ["height", "paddingTop", "paddingBottom", "marginTop", "marginBottom"];
     "border-box" === e.CSS.getPropertyValue(b, "boxSizing").toString().toLowerCase() && (i = ["height"]), f.each(i, function (a, c) {
      h += parseFloat(e.CSS.getPropertyValue(b, c))
     })
    }), e.animate(g, {
     height: ("In" === b ? "+" : "-") + "=" + h
    }, {
     queue: !1,
     easing: "ease-in-out",
     duration: c * ("In" === b ? .6 : 1)
    })
   }
   return e.Redirects[a] = function (d, g, h, i, j, k, l) {
    var m = h === i - 1,
     n = 0;
    l = l || b.loop, "function" == typeof b.defaultDuration ? b.defaultDuration = b.defaultDuration.call(j, j) : b.defaultDuration = parseFloat(b.defaultDuration);
    for (var o = 0; o < b.calls.length; o++) "number" == typeof (t = b.calls[o][1]) && (n += t);
    var p = n >= 1 ? 0 : b.calls.length ? (1 - n) / b.calls.length : 1;
    for (o = 0; o < b.calls.length; o++) {
     var q = b.calls[o],
      r = q[0],
      s = 1e3,
      t = q[1],
      u = q[2] || {},
      v = {};
     if (void 0 !== g.duration ? s = g.duration : void 0 !== b.defaultDuration && (s = b.defaultDuration), v.duration = s * ("number" == typeof t ? t : p), v.queue = g.queue || "", v.easing = u.easing || "ease", v.delay = parseFloat(u.delay) || 0, v.loop = !b.loop && u.loop, v._cacheValues = u._cacheValues || !0, 0 === o) {
      if (v.delay += parseFloat(g.delay) || 0, 0 === h && (v.begin = function () {
        g.begin && g.begin.call(j, j);
        var b = a.match(/(In|Out)$/);
        b && "In" === b[0] && void 0 !== r.opacity && f.each(j.nodeType ? [j] : j, function (a, b) {
         e.CSS.setPropertyValue(b, "opacity", 0)
        }), g.animateParentHeight && b && c(j, b[0], s + v.delay, g.stagger)
       }), null !== g.display)
       if (void 0 !== g.display && "none" !== g.display) v.display = g.display;
       else if (/In$/.test(a)) {
       var w = e.CSS.Values.getDisplayType(d);
       v.display = "inline" === w ? "inline-block" : w
      }
      g.visibility && "hidden" !== g.visibility && (v.visibility = g.visibility)
     }
     if (o === b.calls.length - 1) {
      var x = function () {
       void 0 !== g.display && "none" !== g.display || !/Out$/.test(a) || f.each(j.nodeType ? [j] : j, function (a, b) {
        e.CSS.setPropertyValue(b, "display", "none")
       }), g.complete && g.complete.call(j, j), k && k.resolver(j || d)
      };
      v.complete = function () {
       if (l && e.Redirects[a](d, g, h, i, j, k, !0 === l || Math.max(0, l - 1)), b.reset) {
        for (var c in b.reset)
         if (b.reset.hasOwnProperty(c)) {
          var f = b.reset[c];
          void 0 !== e.CSS.Hooks.registered[c] || "string" != typeof f && "number" != typeof f || (b.reset[c] = [b.reset[c], b.reset[c]])
         } var n = {
         duration: 0,
         queue: !1
        };
        m && (n.complete = x), e.animate(d, b.reset, n)
       } else m && x()
      }, "hidden" === g.visibility && (v.visibility = g.visibility)
     }
     e.animate(d, r, v)
    }
   }, e
  }, e.RegisterEffect.packagedEffects = {

   "transition.slideUpIn": {
    defaultDuration: 900,
    calls: [[{
     opacity: [1, 0],
     translateY: [0, 20],
     translateZ: 0
    }]]
   },
   "transition.slideUpOut": {
    defaultDuration: 900,
    calls: [[{
     opacity: [0, 1],
     translateY: -20,
     translateZ: 0
    }]],
    reset: {
     translateY: 0
    }
   },




  };
  for (var j in e.RegisterEffect.packagedEffects) e.RegisterEffect.packagedEffects.hasOwnProperty(j) && e.RegisterEffect(j, e.RegisterEffect.packagedEffects[j]);
  e.RunSequence = function (a) {
   var b = f.extend(!0, [], a);
   b.length > 1 && (f.each(b.reverse(), function (a, c) {
    var d = b[a + 1];
    if (d) {
     var g = c.o || c.options,
      h = d.o || d.options,
      i = g && !1 === g.sequenceQueue ? "begin" : "complete",
      j = h && h[i],
      k = {};
     k[i] = function () {
      var a = d.e || d.elements,
       b = a.nodeType ? [a] : a;
      j && j.call(b, b), e(c)
     }, d.o ? d.o = f.extend({}, h, k) : d.options = f.extend({}, h, k)
    }
   }), b.reverse()), e(b[0])
  }
 }(window.jQuery || window.Zepto || window, window, window ? window.document : undefined)
});
