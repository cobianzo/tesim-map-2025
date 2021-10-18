    <!-- Start snippet -->
    <script src="https://static.kuula.io/api.js"></script>
    <style>
        :root {
            --k-environment: #59a05d;
            --k-p2p: #9a2c6f;
            --k-economic: #296180;
            --k-infrastructure: #c9493e;
            --k-font-family: "Century Gothic", 'Didact Gothic', -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .kuula-supercontainer {
            font-family: var(--k-font-family);
            background: #71296F;
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
        .kuula-buttons {
            z-index: 10;
            display: flex;
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
            display: none;
            padding-top: 10px;
            font-size: 12px;
            text-transform: uppercase;
        }
        .kuula-buttons button:hover {
            opacity: 1;
            background-color: #2b3788;
            background-position: center center;
            
        }
        .kuula-buttons button.current {
            opacity: 1;
            font-size: 30px;
            background-position: center top;
        }
        /* entrance hall btn */ /* Go back button */
        button[data-post="76vt7"] { 
            position: absolute;
            display: none; /* by default, we show it when needed */
            top: 70px;
            height: 120px;
            width: 120px;
            padding: 0;
            border-radius: 50%;
            opacity: 1;
            z-index: 9;
            margin: 20px;
            flex-grow: 0; 
            font-size: 10px;
            transition: all 0.5s;
            background-position: center bottom;
            box-shadow: 2px 2px 9px black;
            color: black;
        }   button[data-post="76vt7"] span { font-size: 12px; }
            button[data-post="76vt7"]:hover span { color: white; }
        /* entrance hall btn */ /* Go back button  when hidden */
        .kuula-container[data-currentpost="76vt7"] button[data-post="76vt7"] {
            transform: translateX(-20000px);
            width: 0;
        }
        /* env, p2p, eco, inf buttons  */
        button[data-post="76RYn"] {
            background: var(--k-environment) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-environment.jpg');
        } .kuula-container[data-currentpost="76RYn"] .kuula-vr { border-color: var(--k-environment); }
        button[data-post="7glSh"] {
            background: var(--k-p2p) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-people-to-people.jpg');
        } .kuula-container[data-currentpost="7glSh"] .kuula-vr { border-color: var(--k-p2p); }
        button[data-post="7gXLP"] {
            background: var(--k-economic) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-economic2.jpg');
        }.kuula-container[data-currentpost="7gXLP"] .kuula-vr { border-color: var(--k-economic); }
        button[data-post="7g9Fj"] {
            background: var(--k-infrastructure) url('https://tesim-enicbc.eu/wp-content/themes/understrap-child-master/img/hp-infrastructure.jpg');
        }.kuula-container[data-currentpost="7g9Fj"] .kuula-vr { border-color: var(--k-infrastructure); }
        @media screen and (max-width: 767px) {
            .kuula-buttons {
                position: absolute;
                width: 100%;
            }
        }
        @media screen and (min-width: 768px) {
            .kuula-buttons button {
                font-size: 17px;
            }
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
            <div class='kuula-buttons'>
                <button class="k-home" data-post="76vt7"><span>⬅ <br/>Back Home</span></button>
                <button class="k-envir" data-post="76RYn">
                    <!-- <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIHZpZXdCb3g9IjAgMCAxMCAxMCIgZmlsbD0ibm9uZSI+ICAgIDxwYXRoIGQ9Ik01IDdMMSAzSDlMNSA3WiIgZmlsbD0iYmxhY2siLz48L3N2Zz4="/> -->
                    <!-- <span>... share the same home</span><br/> -->
                    <span>Projects</span>
                    <b>Environment</b>
                </button>
                <button class="k-p2p" data-post="7glSh"><span>Projects</span><b>People to People</b></button>
                <button class="k-econom" data-post="7gXLP"><span>Projects</span><b>Economic development</b></button>
                <button class="k-infra" data-post="7g9Fj"><span>Projects</span><b>Cross-border infrastructure</b></button>
                
                
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
                    console.log(e);
                    // on click buttons
                    e.data.posts.forEach(function(post) {
                        
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
                    document.querySelector('.kuula-container').setAttribute('data-currentpost', e.data.id);
                    document.querySelectorAll('.kuula-buttons button').forEach(function(pb) {
                        // Highlight the button if the id saved on the button 
                        // is the same as the id of the loaded post
                        pb.classList.toggle('current', pb.getAttribute('data-post') == e.data.id);
                    });
                });
            </script>
            </div>
            
        </div>
    </div>
    <!-- end snippet virtual tour -->