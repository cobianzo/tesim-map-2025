import React from 'react'
import Europe from "./SVGEurope";


import useKeyPress from './helpers/useKeyPress';
//import Brazil from "@svg-maps/brazil";
// import "react-svg-map/lib/index.css";
import './Map.scss';
import SearchByRegion from './SearchByRegion';
import ProgrammePanel from './ProgrammePanel';
import PanelHoveredRegion from './PanelHoveredRegion';
import PanelSelectedRegion from './PanelSelectedRegion';


export default function Map( { allProgrammes, allProjects, 
                                allRegionsInfo, allCountriesInfo,
                                regionsToProgrammes,
                                appOptions  } ) {
    
    const classSelectablePath = 'cls-2';

    // **** STATES *****
    const refContainer = React.useRef();
    const refSVG = React.useRef();
    const [hovered, setHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
    const [regionSelected, setRegionSelected] = React.useState(null); // ID of region selected.    
    const [countrySelected, setCountrySelected] = React.useState(null); // ID of region selected.    
    const [projectInModal, setProjectInModal] = React.useState(null);

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
    // key escape listener: close the modal window with the project info
    useKeyPress('Escape', () => { 
        if (projectInModal)
            setProjectInModal(null);
        else if (regionSelected) setRegionSelected(null);
    }, [regionSelected, projectInModal]);

    // **** WATCH hovered (a region is hovered!) *****
    
    // React.useEffect( () => {
    //     if (selected) return;
    //     if (!regionsToProgrammes?.nuts3) return;
    // }, [hovered]); // hovered is a region ID

    // watch selected region: WHEN clicking on a region in the map
    React.useEffect( () => {
        if (regionSelected && regionsToProgrammes && regionsToProgrammes.nuts3[regionSelected]) { 
            // when selected region
            // add classes to DOM svg els
            let path = refContainer.current.querySelector('.selected');
            if (path) path.classList.remove('selected');
            path = refContainer.current.querySelector('#' + regionSelected);
            if (path) path.classList.add('selected');

            const countryCode = regionSelected.substr(0,2);
            setCountrySelected(countryCode);
            return;
        }
        // CLEANUP: when selected region
        const path = refContainer.current.querySelector('.selected');
        if (path) path.classList.remove('selected');
    }, [regionSelected]); // selected is a region ID

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
            if (!refContainer.current) return;
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
            setRegionSelected(hovered);
    }

    // **** FUNCTIONS *****
    // TODO: apply on resize
    function adjustMapResolution() {
        console.log('adjusting size map');
        refSVG.current.setAttribute('height', refSVG.current.clientWidth * 5/12 + 'px');
        refSVG.current.style.transform = `translateX(${refSVG.current.clientWidth/6}px)`;
    }
    // CONTORL OF ESC KEY PRESSED                                                
    const escFunction = (event) => {
        if(event.keyCode === 27) { alert()
            if (projectInModal) setProjectInModal(null);
        }
    }
    // React.useEffect(() => {
    //     document.addEventListener("keydown", escFunction, false);
    //     return () => document.removeEventListener("keydown", escFunction, false);
    // }, []);

    

    // *** T E M P L A T E ******    JXS    *******************************
    /**********************************************************************/ 
    return (
<div    className={`TM_container ${hovered && regionsToProgrammes?.nuts3 && regionsToProgrammes.nuts3[hovered]? 'hovering-region' : ''
                    } ${regionSelected? 'selected-region' : '' }`} 
        ref={refContainer}>

    <div className='TM_row'>
        
            <SearchByRegion allProgrammes={allProgrammes} allProjects={allProjects} regionsToProgrammes={regionsToProgrammes} 
                            allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo} 
                            hovered={hovered} regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                            countrySelected={countrySelected} setCountrySelected={setCountrySelected}
                            allRegionsInfo={allRegionsInfo} />
        
    </div>

    <div className="TM_row border TM_position-relative">
        
        <div className="TM_left-panel border m-5">
            <div className="TM_card">
                <div className="TM_card-header">
                    Info:
                    {regionSelected && 
                    <button onClick={ e => { setRegionSelected(null); setCountrySelected(null); }}
                        className='TM_btn TM_btn-secondary'>
                        Close selection
                    </button>}
                    {process.env.NODE_ENV}
                    {process.env.REACT_APP_PUBLIC_URL}
                </div>
                <div className="TM_card-body">

                    { hovered && !regionSelected && 
                    <PanelHoveredRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                                        regionsToProgrammes={regionsToProgrammes}
                                        hovered={hovered} />}

                    { regionSelected && 
                    <PanelSelectedRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                        regionsToProgrammes={regionsToProgrammes}
                        regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                        appOptions={appOptions}
                        projectInModal={projectInModal} setProjectInModal={setProjectInModal} />}
                    
                </div>
            </div>
        </div>

        {/* The MAP */}
        <div className="TM_map-wrapper TM_col-12 border TM_overflow-hidden">
            <svg ref={refSVG} width='100%' height='230px'
                    className="n" 
                    id="svg-map-container"
                    xmlns='http://www.w3.org/2000/svg'
                    onMouseMove={ handleMouseMove }    
                    onClick={ handleClick }
                >
                <Europe />
            </svg>
        </div>

        {/* The MODAL WINDOW for the selected profject PDF */}
        { projectInModal &&
        <div className="tesim-modal-wrapper" tabIndex="-1" role="dialog" aria-hidden="true"
            onClick={e=>setProjectInModal(null)}>
            <div className="tesim-modal">
                <iframe src={ projectInModal.permalink }>

                </iframe>
            </div>
        </div>
        }
    </div>
</div>
    )
}

