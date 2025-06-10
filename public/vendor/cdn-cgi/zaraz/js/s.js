try {
    (function(w, d) {
        zaraz.debug = (bw="") => {
            document.cookie = `zarazDebug=${bw}; path=/`;
            location.reload()
        }
        ;
        window.zaraz._al = function(ei, ej, ek) {
            w.zaraz.listeners.push({
                item: ei,
                type: ej,
                callback: ek
            });
            ei.addEventListener(ej, ek)
        }
        ;
        zaraz.preview = (ew="") => {
            document.cookie = `zarazPreview=${ew}; path=/`;
            location.reload()
        }
        ;
        zaraz.i = function(bd) {
            const be = d.createElement("div");
            be.innerHTML = unescape(bd);
            const bf = be.querySelectorAll("script")
              , bg = d.querySelector("script[nonce]")
              , bh = bg?.nonce || bg?.getAttribute("nonce");
            for (let bi = 0; bi < bf.length; bi++) {
                const bj = d.createElement("script");
                bh && (bj.nonce = bh);
                bf[bi].innerHTML && (bj.innerHTML = bf[bi].innerHTML);
                for (const bk of bf[bi].attributes)
                    bj.setAttribute(bk.name, bk.value);
                d.head.appendChild(bj);
                bf[bi].remove()
            }
            d.body.appendChild(be)
        }
        ;
        zaraz.f = async function(bl, bm) {
            const bn = {
                credentials: "include",
                keepalive: !0,
                mode: "no-cors"
            };
            if (bm) {
                bn.method = "POST";
                bn.body = new URLSearchParams(bm);
                bn.headers = {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }
            return await fetch(bl, bn)
        }
        ;
        window.zaraz._p = async dq => new Promise((dr => {
            if (dq) {
                dq.e && dq.e.forEach((ds => {
                    try {
                        const dt = d.querySelector("script[nonce]")
                          , du = dt?.nonce || dt?.getAttribute("nonce")
                          , dv = d.createElement("script");
                        du && (dv.nonce = du);
                        dv.innerHTML = ds;
                        dv.onload = () => {
                            d.head.removeChild(dv)
                        }
                        ;
                        d.head.appendChild(dv)
                    } catch (dw) {
                        console.error(`Error executing script: ${ds}\n`, dw)
                    }
                }
                ));
                Promise.allSettled((dq.f || []).map((dx => fetch(dx[0], dx[1]))))
            }
            dr()
        }
        ));
        zaraz.pageVariables = {};
        zaraz.__zcl = zaraz.__zcl || {};
        zaraz.track = async function(eA, eB, eC) {
            return new Promise(( (eD, eE) => {
                const eF = {
                    name: eA,
                    data: {}
                };
                if (eB?.__zarazClientEvent)
                    Object.keys(localStorage).filter((eH => eH.startsWith("_zaraz_google_consent_"))).forEach((eG => eF.data[eG] = localStorage.getItem(eG)));
                else {
                    for (const eI of [localStorage, sessionStorage])
                        Object.keys(eI || {}).filter((eK => eK.startsWith("_zaraz_"))).forEach((eJ => {
                            try {
                                eF.data[eJ.slice(7)] = JSON.parse(eI.getItem(eJ))
                            } catch {
                                eF.data[eJ.slice(7)] = eI.getItem(eJ)
                            }
                        }
                        ));
                    Object.keys(zaraz.pageVariables).forEach((eL => eF.data[eL] = JSON.parse(zaraz.pageVariables[eL])))
                }
                Object.keys(zaraz.__zcl).forEach((eM => eF.data[`__zcl_${eM}`] = zaraz.__zcl[eM]));
                eF.data.__zarazMCListeners = zaraz.__zarazMCListeners;
                //
                eF.data = {
                    ...eF.data,
                    ...eB
                };
                eF.zarazData = zarazData;
                fetch("/cdn-cgi/zaraz/t", {
                    credentials: "include",
                    keepalive: !0,
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(eF)
                }).catch(( () => {
                    //
                    return fetch("/cdn-cgi/zaraz/t", {
                        credentials: "include",
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(eF)
                    })
                }
                )).then((function(eO) {
                    zarazData._let = (new Date).getTime();
                    eO.ok || eE();
                    return 204 !== eO.status && eO.json()
                }
                )).then((async eN => {
                    await zaraz._p(eN);
                    "function" == typeof eC && eC()
                }
                )).finally(( () => eD()))
            }
            ))
        }
        ;
        zaraz.set = function(eP, eQ, eR) {
            try {
                eQ = JSON.stringify(eQ)
            } catch (eS) {
                return
            }
            prefixedKey = "_zaraz_" + eP;
            sessionStorage && sessionStorage.removeItem(prefixedKey);
            localStorage && localStorage.removeItem(prefixedKey);
            delete zaraz.pageVariables[eP];
            if (void 0 !== eQ) {
                eR && "session" == eR.scope ? sessionStorage && sessionStorage.setItem(prefixedKey, eQ) : eR && "page" == eR.scope ? zaraz.pageVariables[eP] = eQ : localStorage && localStorage.setItem(prefixedKey, eQ);
                zaraz.__watchVar = {
                    key: eP,
                    value: eQ
                }
            }
        }
        ;
        for (const {m: eT, a: eU} of zarazData.q.filter(( ({m: eV}) => ["debug", "set"].includes(eV))))
            zaraz[eT](...eU);
        for (const {m: eW, a: eX} of zaraz.q)
            zaraz[eW](...eX);
        delete zaraz.q;
        delete zarazData.q;
        zaraz.spaPageview = () => {
            zarazData.l = d.location.href;
            zarazData.t = d.title;
            zaraz.pageVariables = {};
            zaraz.__zarazMCListeners = {};
            zaraz.track("__zarazSPA")
        }
        ;
        zaraz.fulfilTrigger = function(dY, dZ, d$, ea) {
            zaraz.__zarazTriggerMap || (zaraz.__zarazTriggerMap = {});
            zaraz.__zarazTriggerMap[dY] || (zaraz.__zarazTriggerMap[dY] = "");
            zaraz.__zarazTriggerMap[dY] += "*" + dZ + "*";
            zaraz.track("__zarazEmpty", {
                ...d$,
                __zarazClientTriggers: zaraz.__zarazTriggerMap[dY]
            }, ea)
        }
        ;
        zaraz._processDataLayer = bp => {
            for (const bq of Object.entries(bp))
                zaraz.set(bq[0], bq[1], {
                    scope: "page"
                });
            if (bp.event) {
                if (zarazData.dataLayerIgnore && zarazData.dataLayerIgnore.includes(bp.event))
                    return;
                let br = {};
                for (let bs of dataLayer.slice(0, dataLayer.indexOf(bp) + 1))
                    br = {
                        ...br,
                        ...bs
                    };
                delete br.event;
                bp.event.startsWith("gtm.") || zaraz.track(bp.event, br)
            }
        }
        ;
        window.dataLayer = w.dataLayer || [];
        const bo = w.dataLayer.push;
        Object.defineProperty(w.dataLayer, "push", {
            configurable: !0,
            enumerable: !1,
            writable: !0,
            value: function(...bt) {
                let bu = bo.apply(this, bt);
                zaraz._processDataLayer(bt[0]);
                return bu
            }
        });
        dataLayer.forEach((bv => zaraz._processDataLayer(bv)));
        zaraz._cts = () => {
            zaraz._timeouts && zaraz._timeouts.forEach((bx => clearTimeout(bx)));
            zaraz._timeouts = []
        }
        ;
        zaraz._rl = function() {
            w.zaraz.listeners && w.zaraz.listeners.forEach((by => by.item.removeEventListener(by.type, by.callback)));
            window.zaraz.listeners = []
        }
        ;
        history.pushState = function() {
            try {
                zaraz._rl();
                zaraz._cts && zaraz._cts()
            } finally {
                History.prototype.pushState.apply(history, arguments);
                setTimeout(zaraz.spaPageview, 100)
            }
        }
        ;
        history.replaceState = function() {
            try {
                zaraz._rl();
                zaraz._cts && zaraz._cts()
            } finally {
                History.prototype.replaceState.apply(history, arguments);
                setTimeout(zaraz.spaPageview, 100)
            }
        }
        ;
        zaraz._c = cS => {
            const {event: cT, ...cU} = cS;
            zaraz.track(cT, {
                ...cU,
                __zarazClientEvent: !0
            })
        }
        ;
        zaraz._syncedAttributes = ["altKey", "clientX", "clientY", "pageX", "pageY", "button"];
        zaraz.__zcl.track = !0;
        zaraz._p({
            "e": ["(function(w,d){;w.zarazData.executed.push(\"Pageview\");})(window,document)", "(function(w,d){})(window,document)"]
        })
    }
    )(window, document)
} catch (e) {
    throw fetch("/cdn-cgi/zaraz/t"),
    e;
}
