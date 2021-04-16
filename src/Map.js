import React from 'react'
import Europe from "./SVGEurope";

import ProjectInfo from './ProjectInfo';
//import Brazil from "@svg-maps/brazil";
// import "react-svg-map/lib/index.css";
import './Map.scss';
import SearchByRegion from './SearchByRegion';
import ProgrammePanel from './ProgrammePanel';
import PanelHoveredRegion from './PanelHoveredRegion';
import PanelSelectedRegion from './PanelSelectedRegion';


export default function Map( { allProgrammes, allProjects, 
                                allRegionsInfo, allCountriesInfo,
                                regionsToProgrammes,  } ) {
    
    const classSelectablePath = 'cls-2';

    // **** STATES *****
    const refContainer = React.useRef();
    const refSVG = React.useRef();
    const [hovered, setHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
    const [selected, setSelected] = React.useState(null); // ID of region selected.    
    const [countrySelected, setCountrySelected] = React.useState(null); // ID of region selected.    

    // **** ON MOUNT *****
    React.useEffect( () => {
        adjustMapResolution();
    }, []);
    React.useEffect( () => {
        if (!regionsToProgrammes || !regionsToProgrammes.nuts3 || !Object.keys(regionsToProgrammes.nuts3).length) return;
        Object.keys(regionsToProgrammes.nuts3).forEach( regCode => {
            const path = refSVG.current.getElementById(regCode)
            path.classList.add('selectable');
        });
    }, [regionsToProgrammes.nuts3]);

    // **** WATCH hovered (a region is hovered!) *****
    
    // React.useEffect( () => {
    //     if (selected) return;
    //     if (!regionsToProgrammes?.nuts3) return;
    // }, [hovered]); // hovered is a region ID

    // watch selected region: WHEN clicking on a region in the map
    React.useEffect( () => {
        if (selected && regionsToProgrammes && regionsToProgrammes.nuts3[selected]) { 
            // when selected region
            // add classes to DOM svg els
            let path = refContainer.current.querySelector('.selected');
            if (path) path.classList.remove('selected');
            path = refContainer.current.querySelector('#' + selected);
            if (path) path.classList.add('selected');

            const countryCode = selected.substr(0,2);
            setCountrySelected(countryCode);
            return;
        }
        // CLEANUP: when selected region
        const path = refContainer.current.querySelector('.selected');
        if (path) path.classList.remove('selected');
    }, [selected]); // selected is a region ID

    // watch selection of country in dropdown.
    React.useEffect(() => {
        if (countrySelected && regionsToProgrammes && regionsToProgrammes.countries[countrySelected]) { 
            let path = refContainer.current.querySelector('.country-selected');
            if (path) path.classList.remove('country-selected');
            path = refContainer.current.querySelector('#' + countrySelected + '0'); // path#es0
            if (path) path.classList.add('country-selected');
        }
        return () => {
            // cleanup
            const path = refContainer.current.querySelector('#' + countrySelected + '0'); // path#es0
            if (path) path.classList.remove('country-selected');
        }
    }, [countrySelected])

    // **** HANDLERS *****
    const handleMouseMove = e => {
        // grab the hovered svg path and update the 'hovered' var with that code , ie es032
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
    

    // *** T E M P L A T E ******    JXS    *******************************
    /**********************************************************************/ 
    return (
        <div    className={`container ${hovered && regionsToProgrammes?.nuts3[hovered]? 'hovering-region' : ''} ${selected? 'selected-region' : '' }`} 
                ref={refContainer}>

            <div className='row'>
                
                    <SearchByRegion allProgrammes={allProgrammes} allProjects={allProjects} regionsToProgrammes={regionsToProgrammes} 
                                    allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo} 
                                    hovered={hovered} selected={selected} setSelected={setSelected}
                                    countrySelected={countrySelected} setCountrySelected={setCountrySelected}
                                    allRegionsInfo={allRegionsInfo} />
                
            </div>

            <div className="row border">
                
                <div className="col-4 border">
                    <div className="card">
                        <div className="card-header">
                            Info:
                            {selected && <button onClick={ e => { setSelected(null); setCountrySelected(null); }}>
                                Close
                            </button>}
                            {process.env.NODE_ENV}
                            {process.env.REACT_APP_PUBLIC_URL}
                        </div>
                        <div className="card-body">

                            { hovered && !selected && 
                            <PanelHoveredRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                                                allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                                                regionsToProgrammes={regionsToProgrammes}
                                                hovered={hovered} />}

                            { selected && 
                            <PanelSelectedRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                                allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                                regionsToProgrammes={regionsToProgrammes}
                                selected={selected} setSelected={setSelected} />}
                            
                        </div>
                    </div>
                </div>

                {/* The MAP */}
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

