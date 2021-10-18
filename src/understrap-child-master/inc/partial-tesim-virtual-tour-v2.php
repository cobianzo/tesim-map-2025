    <!-- Start snippet -->
    <script src="https://static.kuula.io/api.js"></script>
    <style>
        :root {
            --k-primary: #742670;
            --k-environment: #59a05d;
            --k-p2p: #9a2c6f;
            --k-economic: #296180;
            --k-infrastructure: #c9493e;
            --k-font-family: "Century Gothic", 'Didact Gothic', -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        @keyframes dot-expander {
            from { transform: scale3d(1, 1, 1); }
            50% { transform: scale3d(1.05, 1.05, 1.05); }
            to { transform: scale3d(1, 1, 1); }
        }

        .kuula-supercontainer {
            font-family: var(--k-font-family);
        }
            .kuula-supercontainer[data-currentpost="home"] {
                background-color: var(--k-primary);
            }
            .kuula-supercontainer[data-currentpost="envir"] {
                background-color: var(--k-environment);
            }
            .kuula-supercontainer[data-currentpost="p2p"] {
                background-color: var(--k-p2p);
            }
            .kuula-supercontainer[data-currentpost="econom"] {
                background-color: var(--k-economic);
            }
            .kuula-supercontainer[data-currentpost="infra"] {
                background-color: var(--k-infrastructure);
            }
        .kuula-title{  /*not in use */
            display: block;
            text-align: center;
        }
        .kuula-title h2 { 
            font-size: 3rem;
            margin: 0;
            color: white;
            text-transform: uppercase;
            padding: 20px;
            
        }
        .kuula-container {
            display: flex;
            flex-direction: column;
            position: relative;
            background-color: #86ADCA;
        }
        .kuula-vr {
            position: relative;
            flex-grow: 1;
            min-height: 500px;
            /* border: 5px solid #71296F; */
        }
        .kuula-vr iframe {
            position: absolute;
            height: 100%;
        }
        /** button top open the map in new window */
        .kuula-topright-button {
            position: absolute;
            bottom: 0px; /*  mobile */
            left: 10px;
            width: 100px;
            z-index: 9;
            text-align: center;
        }
            @media screen and (min-width: 767px) {
                .kuula-topright-button {
                    top: 10px;
                    bottom: auto;
                }
            }
        .k-open-map{
            
        }
        .k-open-map .k-arrow-animated {
            position: absolute;
            top: 0;
            z-index: 8;
            left: 36px;
            opacity: 0;
        }
        .k-open-map:hover img {
            animation: dot-expander 1.0s infinite;
        }
        .kuula-topright-button .k-inner-text {
            opacity: 0; 
            transition: all 1s;
            font-weight: bold;
            line-height: 1;
            display: block; 
            margin-bottom: 10px;
            text-shadow: -1px 1px 5px white;
        }
            .k-open-map:hover .k-inner-text {
                opacity: 1;
            }
        .kuula-buttons {
            z-index: 10;
            display: flex;
            width: 100%;
        }
        .kuula-buttons button {
            font-family: var(--k-font-family);
            flex-grow: 1;
            font-size: 11px;
            text-align: center;
            padding: 0px 5px 0px;
            cursor: pointer;
            border: 0;
            border-radius: 0;
            color: white;
            opacity: 0.85;
            transition: all 0.5s;
        }
        
        .kuula-buttons button span {
            text-align: center;
            display: block;
            text-transform: uppercase;
            padding: 20px 5px;
            font-size: 12px;
        }
        .kuula-buttons button b {
            opacity: 0;
            transition: all 0.5s;
            padding: 0;
            margin-top: -20px;
            font-size: 12px;
            display: none;
            text-transform: uppercase;
        }
        .kuula-buttons button:hover {
            opacity: 1;
            background-color: #2b3788;
            background-position: center center;            
        }
        .kuula-buttons button:hover b {
            display: block;
            opacity: 1;
        }
        .kuula-buttons button.current {
            opacity: 1;
            font-size: 30px;
            background-position: center top;
        }
        .kuula-buttons button.current span {
            padding-top: 10px;
        }
        .kuula-buttons button.current b {
            opacity: 0; /** animate with js */
            display: block;
            transition: all 0.5s;
        }
        /* entrance hall btn */ /* Go back button */
        button.k-home { 
            position: absolute;
            display: none; /* by default, we show it when needed */
            top: 57px;
            padding: 0;
            opacity: 1;
            z-index: 9;
            margin: 20px;
            flex-grow: 0; 
            font-size: 10px;
            transition: all 0.5s;
            background-position: center bottom;
            box-shadow: 2px 2px 9px black;
            color: black;
        }   button.k-home span { font-size: 12px; padding: 5px; }
            button.k-home:hover span { color: white; }
        /* entrance hall btn */ /* Go back button  when hidden */
        .kuula-container[data-currentpost="76vt7"] button.k-home {
            transform: translateX(-20000px);
            width: 0;
        }
        /* env, p2p, eco, inf buttons  */
        button[data-post="76RYn"] {
            background: var(--k-environment) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-environment.jpg');
        }   .kuula-container[data-currentpost="76RYn"] { background-color: #A2D0DE; }
            .kuula-container[data-currentpost="76RYn"] .kuula-vr { border-color: var(--k-environment); }
        button[data-post="7glSh"] {
            background: var(--k-p2p) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-people-to-people.jpg');
        }   .kuula-container[data-currentpost="7glSh"] { background-color: #92C6D5; }
            .kuula-container[data-currentpost="7glSh"] .kuula-vr { border-color: var(--k-p2p); }
        button[data-post="7gXLP"] {
            background: var(--k-economic) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-economic2.jpg');
        }   .kuula-container[data-currentpost="7gXLP"] { background-color: #C3FFFF; }
            .kuula-container[data-currentpost="7gXLP"] .kuula-vr { border-color: var(--k-economic); }
        button[data-post="7g9Fj"] {
            background: var(--k-infrastructure) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-infrastructure.jpg');
        }   .kuula-container[data-currentpost="7g9Fj"] { background-color: #4CDDF8; }
            .kuula-container[data-currentpost="7g9Fj"] .kuula-vr { border-color: var(--k-infrastructure); }
        @media screen and (max-width: 767px) {
            .kuula-buttons {
                position: absolute;
                width: 100%;
            }
        }
        @media screen and (min-width: 768px) {
            .kuula-supercontainer { 
                padding: 5px 5px 80px; /*Space for the buttons below */
                flex: 1 1 100%;
            }
            .kuula-buttons {
                position: absolute;
                bottom: -75px;
            }
            .kuula-buttons button {
                border-radius: 5px;
                font-size: 17px;
            }
            .kuula-buttons button.k-topbtn { 
                margin: 10px 5px 0;
            }
            button.k-home { 
                top: auto;
                bottom: 100px;
                height: 120px;
                width: 120px;
                border-radius: 50%;
            } button.k-home span {  padding: 20px 5px; }
            .kuula-buttons button span { font-size: 20px; }
            /* .kuula-container {
                flex-direction: row-reverse;
            }
            .kuula-buttons {
                flex-direction: column;
                width: 200px;
            }    */
        }
    </style>
    <div class="kuula-supercontainer">
        <div class="kuula-container">
            <div class='kuula-topright-button'>
                <a class="k-open-map" href="https://tesim-enicbc.eu/projects-map" 
                    target="<?php 
                        $frontpage_id = get_option( 'page_on_front' );
                        if ($frontpage_id == get_the_ID()) echo "_blank";
                        else echo "_self";                    
                    ?>"
                    >
                    <img src="https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/icon-open-map.png" alt="open map" />
                    <img class='k-arrow-animated' src="https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/open-map-arrow.png" alt="open map" />
                    <span class="k-inner-text"> 
                        Interactive project map
                    </span>
                </a>
            </div>
            <div class='kuula-buttons'>
                <button class="k-home" data-post="76vt7" data-postname='home'><span>⬅ <br/>HALL</span></button>
                <button class="k-envir k-topbtn" data-post="76RYn"  data-postname='home' title="Environment">
                    <span>Projects</span>
                    <b>Environment</b>
                </button>
                <button class="k-p2p k-topbtn" data-post="7glSh"  data-postname='p2p' title="People to People">
                    <span>Projects</span>
                    <b>People to People</b>
                </button>
                <button class="k-econom k-topbtn" data-post="7gXLP"  data-postname='econom' title="Economic development">
                    <span>Projects</span>
                    <b>Economic development</b>
                </button>
                <button class="k-infra k-topbtn" data-post="7g9Fj"  data-postname='infra' title="Cross-border infrastructure">
                    <span>Projects</span>
                    <b>Cross-border infrastructure</b>
                </button>
            </div>
            <div class='kuula-vr'>
                <script src="https://static.kuula.io/embed.js" data-kuula="https://kuula.co/share/collection/7PKST?fs=1&vr=1&sd=1&initload=1&thumbs=4&card=0&info=0&logo=-1&zoom=1"
                data-width="100%" data-height="100%"></script>
            <script>
                // let btnTesim1 = document.querySelector('.cd-projects-previews li a:nth-child(1)');
                // if (btnTesim1) btnTesim1.addEventListener('click', function(e){
                //     document.querySelector('.k-infra').click();
                // });
                // let btnTesim2 = document.querySelector('.cd-projects-previews li a:nth-child(2)');
                // if (btnTesim2) btnTesim2.addEventListener('click', function(e){
                //     document.querySelector('.k-econom').click();
                // });
                // let btnTesim3 = document.querySelector('.cd-projects-previews li a:nth-child(3)');
                // if (btnTesim3) btnTesim3.addEventListener('click', function(e){
                //     document.querySelector('.k-envir').click();
                // });
                // let btnTesim4 = document.querySelector('.cd-projects-previews li a:nth-child(4)');
                // if (btnTesim4) btnTesim4.addEventListener('click', function(e){
                //     document.querySelector('.k-k-p2p').click();
                // });
                // // close buttons in tesim components:
                // let btnTesimClose = document.querySelector('.cd-nav-trigger.cd-text-replace.project-open');
                // if (btnTesimClose) btnTesimClose.addEventListener('click', function(e){
                //     document.querySelector('.k-home').click();
                // });

                // NOW after KUULA CONTROLS 
                KuulaPlayerAPI.addEventListener("frameloaded", function(e) {
                    document.querySelector('.k-home').style.display = 'block';
                    //todelete
                    // console.log(e);
                    // on click buttons
                    e.data.posts.forEach(function(post) {
                        // console.log('TODELETE post', post);
                        const btn = document.querySelector('.kuula-buttons button[data-post="'+post.id+'"]');
                        if (btn)
                            btn.addEventListener( 'click', function(clickEv) {
                                
                                clickEv.preventDefault();
                                KuulaPlayerAPI.load(e.frame, post.id);
                            });
                    });
                });
                // Callback for when an post is loaded in the Kuula embed
                KuulaPlayerAPI.addEventListener("postloaded", function(e) {
                    // console.log('TODELETE: post loaded', e);
                    const btnOfThisPost = document.querySelector('[data-post="'+e.data.id+'"]');
                    const nameId       = btnOfThisPost.getAttribute('data-postname');
                    document.querySelector('.kuula-container').setAttribute('data-currentpost', e.data.id);
                    document.querySelector('.kuula-supercontainer').setAttribute('data-currentpost', nameId);
                    document.querySelectorAll('.kuula-buttons button').forEach(function(pb) {
                        // Highlight the button if the id saved on the button 
                        // is the same as the id of the loaded post
                        pb.classList.toggle('current', pb.getAttribute('data-post') == e.data.id);
                        if (pb.getAttribute('data-post') == e.data.id && pb.querySelector('b')) {
                            // no consigo hacerlo animado con transition!
                            pb.querySelector('b').style.opacity=1;
                        }
                    });
                });

                KuulaPlayerAPI.addEventListener("hotspot", function(e) {
                    console.log("Frame id:          " + e.frame);
                    console.log("Hotspot unique id: " + e.data.uid);
                    console.log("Hotspot name:      " + e.data.name);
                    // document.querySelector('.kuula-buttons').style.position = 'relative';
                });

                

            </script>
            </div>
            
        </div>
    </div>
    <!-- end snippet virtual tour -->
