import React from 'react'
import Europe from "./SVGEurope";

import ProjectInfo from './ProjectInfo';
//import Brazil from "@svg-maps/brazil";
// import "react-svg-map/lib/index.css";
import './Map.scss';


export default function Map( { allProgrammes, allProjects, regionsToProgrammes, allRegionsInfo } ) {
    
    const classSelectablePath = 'cls-2';

    // **** STATES *****
    const refContainer = React.useRef();
    const refSVG = React.useRef();
    const [hovered, setHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
    const [selected, setSelected] = React.useState(null); // ID of region selected.
    const [showingProgramme_s, setShowingProgramme_s] = React.useState(null);

    // **** ON MOUNT *****
    React.useEffect( () => {
        adjustMapResolution();
    }, []);
    React.useEffect( () => {
        if (!regionsToProgrammes || !Object.keys(regionsToProgrammes).length) return;
        Object.keys(regionsToProgrammes).forEach( regCode => {
            const path = refSVG.current.getElementById(regCode)
            path.classList.add('selectable');
        });
    }, [regionsToProgrammes]);

    // **** WATCH hovered (a region is hovered!) *****
    React.useEffect( () => {
        if (selected) return;
        if (hovered && regionsToProgrammes[hovered]) {  // array of prog IDs
            // when hovering region
            const programmesBien = [];
            regionsToProgrammes[hovered].forEach( progID => programmesBien.push(allProgrammes[progID]) );
            refContainer.current.classList.add('is-showing-programmes', 'is-hovering-map');
            setShowingProgramme_s(programmesBien);
            return;
        }
        // when unhovering region. Applying timeout for adding opacity transition with css.
        if (showingProgramme_s) {
            refContainer.current.classList.remove('is-showing-programmes', 'is-hovering-map');
            setTimeout( ()=>setShowingProgramme_s(null),2000);
        }
    }, [hovered]); // hovered is a region ID

    // watch selected region: WHEN clicking on a region in the map
    React.useEffect( () => {
        if (selected && regionsToProgrammes[selected]) { 
            // when selected region
            const programmesBien = [];
            regionsToProgrammes[selected].forEach( progID => programmesBien.push(allProgrammes[progID]) );
            refContainer.current.classList.add('is-showing-programmes', 'is-selected-map');
            setShowingProgramme_s(programmesBien);
            return;
        }
        // CLEANUP: when selected region
        refContainer.current.classList.remove('is-showing-programmes', 'is-selected-map');
        setShowingProgramme_s(null);
    }, [selected]); // selected is a region ID

    // **** HANDLERS *****
    const handleMouseMove = e => {
        
        var x = e.clientX, y = e.clientY,
        elementMouseIsOver = document.elementFromPoint(x, y);
        if (elementMouseIsOver && elementMouseIsOver.classList?.contains(classSelectablePath)) {
            setHovered(elementMouseIsOver.id);
        }
        else setHovered(null);
        //console.log(elementMouseIsOver);
        //var newH = hovered? hovered++ : 1;
        //setHovered(newH);
    }
    const handleClick = e => {
        if (hovered)
            setSelected(hovered);
    }

    // **** FUNCTIONS *****


    // TODO: apply on resize
    function adjustMapResolution() {
        refSVG.current.setAttribute('height', refSVG.current.clientWidth * 7/12 + 'px');
        refSVG.current.style.transform = `translateX(${refSVG.current.clientWidth/6}px)`;
    }
    

    return (
        <div className="container" ref={refContainer}>
            <div className="row border">
                <div className="col-4 border">
                    <div className="card">
                        <div className="card-header">
                            Info:
                            {process.env.NODE_ENV}
                            {process.env.REACT_APP_PUBLIC_URL}
                        </div>
                        <div className="card-body">
                            Hovered: {hovered}, { allRegionsInfo[hovered]?.title } <br/>
                            Selected: {selected}

                            { selected && <div>
                                <div className="badge badge-primary mr-3">{allRegionsInfo[selected]?.title}</div>
                                <button className="btn btn-danger"
                                        onClick={ e => setSelected(null) }>
                                    Close
                                </button>
                            </div>}
                            { showingProgramme_s? ( <>                                
                                { Object.keys(showingProgramme_s).map( programmeSlug => 
                                    <div className="programme-title" key={`prg-${programmeSlug}`}> 
                                        <p className="h2">{ showingProgramme_s[programmeSlug].post_title }</p>
                                        <span className="badge badge-secondary d-block">
                                            { showingProgramme_s[programmeSlug].projects?.length } projects
                                        </span>

                                        { showingProgramme_s[programmeSlug].projects.map( ID => (
                                            <ProjectInfo ID={ID} allProjects={allProjects} />
                                        )) }
                                    </div>
                                )}
                            </>) : null }
                            
                        </div>
                    </div>
                </div>
                <div className="col-8 border overflow-hidden">
                    <svg ref={refSVG} width='100%' height='230px'
                            className="n" id="svg-map-container"
                            xmlns='http://www.w3.org/2000/svg'
                            onMouseMove={ handleMouseMove }    
                            onClick={ handleClick }
                        >
                        <Europe />
                    </svg>
                </div>
            </div>
        </div>
    )
}

