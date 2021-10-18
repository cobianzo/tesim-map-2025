<?php
/**
 * In this inc/ folder
 * 1) Partial to show the Virtual exhibition. `tesim-virtual-tour.php`
 * 2) Inside this partial, partial of the New Virtual exhibition, (better with buttons) `partial-tesim-virtual-tour-v2.php`
 *          and partial for the tesim map entry point, which is THIS FILE 
 * 3) This partial calls the REACT APP, which is inside `inc/react-map/` folder (it is the build folder of the create-react-app)
 * 
 * HOW?
 * 
 * 1) Calculates the name of the js and css files, scanning the `react-map` folder.
 * 2) Calls these css and js, making the React app display.
 * 3) Inside the app, it calls two .json files, with programmes and projects info.
 *      The file `projects-and-programmes.json`, is updated by WP.
 * From now on read the comments on 
 *  `functions-map-projects.php`
 * It has the rest of the logic
 */


// START - calculate the names  like 2.5432mk652.chunk.js . They change on every build.
$directory_react_app    = '/inc/react-map';
$react_files            = fetch_filenames_react_app( get_stylesheet_directory() . $directory_react_app .'/static' );
// now we have the filenames, let's call the react app.

// Function that Calculates the filenames with php. 
function fetch_filenames_react_app($dir) {
    // init
    $main_js                = '';
    $chunk_js               = '';
    $inline_chunk_number    = '';
    $main_css               = '';

    // scandir the folders js and css
	$all_files_js   = scandir($dir . '/js');
	$all_files_css  = scandir($dir . '/css');
    
    // fetch the 3 javascript files created by create react app
    foreach ($all_files_js as $filename) {
        if (strpos($filename, '.js') ===  (strlen($filename) - 3)) {
            if (strpos($filename, 'main.') === 0) {
                // detecting main.d0dcd5a3.chunk.js
                $main_js = $filename;
            } elseif (strpos($filename, '.chunk.js') > 0) { 
                if (strpos($filename, '3.') === 0) {
                    $parts = explode('.', $filename);
                    $inline_chunk_number = $parts[1];
                } else {
                    $chunk_js = $filename;
                }
            }
        } 
    }
    // fetch the main css
    foreach ($all_files_css as $filename) {
        if (strpos($filename, '.css') === (strlen($filename) - 4)) {
            if (strpos($filename, 'main.') === 0) {
                $main_css = $filename;
            }
        }
    }

    return [
        'main_js' => $main_js,
        'chunk_js' => $chunk_js,
        'inline_chunk_number' => $inline_chunk_number,
        'main_css' => $main_css,
    ];
}


?>

<link href="<?php echo get_stylesheet_directory_uri() . $directory_react_app .'/static/css/' . $react_files['main_css']; ?>?v=4" rel="stylesheet">


<noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    <script>
        ! function (e) {
            function t(t) {
                for (var n, i, a = t[0], c = t[1], l = t[2], s = 0, p = []; s < a.length; s++) i = a[s], Object
                    .prototype.hasOwnProperty.call(o, i) && o[i] && p.push(o[i][0]), o[i] = 0;
                for (n in c) Object.prototype.hasOwnProperty.call(c, n) && (e[n] = c[n]);
                for (f && f(t); p.length;) p.shift()();
                return u.push.apply(u, l || []), r()
            }

            function r() {
                for (var e, t = 0; t < u.length; t++) {
                    for (var r = u[t], n = !0, a = 1; a < r.length; a++) {
                        var c = r[a];
                        0 !== o[c] && (n = !1)
                    }
                    n && (u.splice(t--, 1), e = i(i.s = r[0]))
                }
                return e
            }
            var n = {},
                o = {
                    1: 0
                },
                u = [];

            function i(t) {
                if (n[t]) return n[t].exports;
                var r = n[t] = {
                    i: t,
                    l: !1,
                    exports: {}
                };
                return e[t].call(r.exports, r, r.exports, i), r.l = !0, r.exports
            }
            i.e = function (e) {
                var t = [],
                    r = o[e];
                if (0 !== r)
                    if (r) t.push(r[2]);
                    else {
                        var n = new Promise((function (t, n) {
                            r = o[e] = [t, n]
                        }));
                        t.push(r[2] = n);
                        var u, a = document.createElement("script");
                        a.charset = "utf-8", a.timeout = 120, i.nc && a.setAttribute("nonce", i.nc), a.src =
                            function (e) {
                                return i.p + "static/js/" + ({} [e] || e) + "." + {
                                    3: "<?php echo $react_files['inline_chunk_number'];  // calculated with php  ?>"
                                } [e] + ".chunk.js"
                            }(e);
                        var c = new Error;
                        u = function (t) {
                            a.onerror = a.onload = null, clearTimeout(l);
                            var r = o[e];
                            if (0 !== r) {
                                if (r) {
                                    var n = t && ("load" === t.type ? "missing" : t.type),
                                        u = t && t.target && t.target.src;
                                    c.message = "Loading chunk " + e + " failed.\n(" + n + ": " + u + ")", c
                                        .name = "ChunkLoadError", c.type = n, c.request = u, r[1](c)
                                }
                                o[e] = void 0
                            }
                        };
                        var l = setTimeout((function () {
                            u({
                                type: "timeout",
                                target: a
                            })
                        }), 12e4);
                        a.onerror = a.onload = u, document.head.appendChild(a)
                    } return Promise.all(t)
            }, i.m = e, i.c = n, i.d = function (e, t, r) {
                i.o(e, t) || Object.defineProperty(e, t, {
                    enumerable: !0,
                    get: r
                })
            }, i.r = function (e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                    value: "Module"
                }), Object.defineProperty(e, "__esModule", {
                    value: !0
                })
            }, i.t = function (e, t) {
                if (1 & t && (e = i(e)), 8 & t) return e;
                if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                var r = Object.create(null);
                if (i.r(r), Object.defineProperty(r, "default", {
                        enumerable: !0,
                        value: e
                    }), 2 & t && "string" != typeof e)
                    for (var n in e) i.d(r, n, function (t) {
                        return e[t]
                    }.bind(null, n));
                return r
            }, i.n = function (e) {
                var t = e && e.__esModule ? function () {
                    return e.default
                } : function () {
                    return e
                };
                return i.d(t, "a", t), t
            }, i.o = function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t)
            }, i.p = "/", i.oe = function (e) {
                throw console.error(e), e
            };
            var a = this["webpackJsonptesim-map"] = this["webpackJsonptesim-map"] || [],
                c = a.push.bind(a);
            a.push = t, a = a.slice();
            for (var l = 0; l < a.length; l++) t(a[l]);
            var f = c;
            r()
        }([])
    </script>
    <script src="<?php echo get_stylesheet_directory_uri() . $directory_react_app . '/static/js/' . $react_files['chunk_js']; ?>?v=4"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . $directory_react_app . '/static/js/' . $react_files['main_js']; ?>?v=4"></script>
