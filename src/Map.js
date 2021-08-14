import React from 'react'
import Europe from "./SVGEurope";


import useKeyPress from './helpers/useKeyPress';
//import Brazil from "@svg-maps/brazil";
// import "react-svg-map/lib/index.css";
import './Map.scss';
import SearchByRegion from './SearchByRegion';
import ProjectInfo from './ProjectInfo';
import PanelHoveredRegion from './PanelHoveredRegion';
import PanelSelectedRegion from './PanelSelectedRegion';
import PanelProgrammesSearch from './PanelProgrammesSearch';


export default function Map( { allProgrammes, allProjects, 
                                allRegionsInfo, allCountriesInfo,
                                regionsToProgrammes,
                                countriesToProjects,
                                appOptions, setAppOptions  } ) {
    
    const classSelectablePath = 'cls-2';

    // **** STATES *****
    const refContainer = React.useRef();
    const refSVG = React.useRef();
    const [countryHovered, setCountryHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
    const [hovered, setHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
    const [regionSelected, setRegionSelected] = React.useState(null); // ID of region selected.    
    const [countrySelected, setCountrySelected] = React.useState(null); // ID of region selected.    
    const [projectInModal, setProjectInModal] = React.useState(null);

    // State for Mode search by programme
    const [hoveredProgramme, setHoveredProgramme] = React.useState(null);
    const [selectedProgramme, setSelectedProgramme] = React.useState(null);

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
    
    React.useEffect( () => {
        if (!hovered) {
            setCountryHovered(null);
            return;
        }
        // if (regionSelected) return;
        if (!regionsToProgrammes?.nuts3) return;
        // get the country from the region hovered
        const countryCode = hovered.substr(0,2);
        // if country belongs to countries with programmes:
        if (regionsToProgrammes.countries && regionsToProgrammes.countries[countryCode])
            setCountryHovered(countryCode);
    }, [hovered]);//WATCH. hovered is a region ID

    // watch country hovered: add class to highlight
    React.useEffect( () => {
        let domElCountry = refContainer.current.querySelectorAll('.country-hovered');
        if (domElCountry.length)
            domElCountry.forEach(el => el.classList.remove('country-hovered') );
        if (countryHovered) {
            domElCountry = refContainer.current.querySelector('#'+countryHovered+'0'); // es0 is the code of country
            if (domElCountry) {
                domElCountry.classList.add('country-hovered');
            }
        } 
    }, [countryHovered]);//WATCH

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
    }, [regionSelected]);//WATCH. selected is a region ID. Not applicable anymore since we can only select countries.

    // watch selection of country in dropdown.
    React.useEffect(() => {
        if (countrySelected && regionsToProgrammes && regionsToProgrammes.countries[countrySelected]) { 
            // first, the mode of lookup comes back to 'map'.
            setAppOptions(Object.assign( {...appOptions}, { showProjectsType: 'map' }));

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
    }, [countrySelected]);//WATCH (click on a country or selected from dropdown)
    
    // when looking up by programme, if a country weas selected, we deselected it.
    React.useEffect( () => {
        if (appOptions.showProjectsType === 'all-programmes') {
            setCountrySelected(null);
        } else
        if (appOptions.showProjectsType === 'map') {
            setSelectedProgramme(null);
        }
    }, [appOptions.showProjectsType]);//WATCH (change from/to 'select country in map' - 'show programmes and select one')

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
        //if (hovered)
        //    setRegionSelected(hovered);
        if (countryHovered)
            setCountrySelected(countryHovered);
    }
    // key escape listener: close the modal window with the project info
    useKeyPress('Escape', () => { 
        if (projectInModal)
            setProjectInModal(null);
        else if (regionSelected) setRegionSelected(null);
    }, [regionSelected, projectInModal]);


    // **** FUNCTIONS *****
    // TODO: apply on resize
    function adjustMapResolution() {
        console.log('adjusting size map');
        refSVG.current.setAttribute('height', refSVG.current.clientWidth * 5/12 + 'px');
        refSVG.current.style.transform = `translateX(${refSVG.current.clientWidth/6}px)`;
    }
    
    

    // *** T E M P L A T E ******    JSX    *******************************
    /**********************************************************************/ 
    return (
<div    className={`TM_container ${hovered && regionsToProgrammes?.nuts3 && regionsToProgrammes.nuts3[hovered]? 'hovering-region' : ''
                    } ${regionSelected? 'selected-region' : '' }`} 
        ref={refContainer}>

    <div className='TM_row'>
        
            <SearchByRegion allProgrammes={allProgrammes} allProjects={allProjects} regionsToProgrammes={regionsToProgrammes} 
                            allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo} 
                            hovered={hovered} countryHovered={countryHovered} 
                            regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                            countrySelected={countrySelected} setCountrySelected={setCountrySelected}
                            allRegionsInfo={allRegionsInfo} />
        
    </div>

    <div className="TM_row border TM_position-relative">
        
        {/* Panel on the left. Shows info of selected country or shows Search by programme */}
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
                    { countrySelected && countriesToProjects[countrySelected] && (
                        <div className='Panel-list-of-projects'>
                            <div className="btn-wrapper">
                                <button className="TM_btn TM_btn-close "
                                        onClick={ e=>setCountrySelected(null)}>
                                    Close
                                </button>
                            </div>
                            <ul class="TM_list-of-projects">
                            { countriesToProjects[countrySelected].map( projectId => {
                                const projInfo = allProjects.find( pro => projectId === pro.ID );
                                return <ProjectInfo 
                                        setProjectInModal={setProjectInModal}
                                        projectInfo={projInfo} key={`pi-${projectId}`}/>
                                }
                            ) }
                            </ul>
                    </div>)}
                    { regionSelected && 
                    <PanelSelectedRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                        regionsToProgrammes={regionsToProgrammes}
                        regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                        appOptions={appOptions}
                        projectInModal={projectInModal} setProjectInModal={setProjectInModal} />}
                    
                    {/* If btn lookup by programme was clicked */}
                    { appOptions.showProjectsType === 'all-programmes' && (
                        <PanelProgrammesSearch 
                            allProgrammes={allProgrammes} allProjects={allProjects}
                            setProjectInModal={setProjectInModal}
                            hoveredProgramme={hoveredProgramme} setHoveredProgramme={setHoveredProgramme}
                            selectedProgramme={selectedProgramme} setSelectedProgramme={setSelectedProgramme}
                        />
                    )}

                </div>
            </div>
        </div>

        {/* Panel on the right: shows infor of hovered region */}
        { hovered && !regionSelected && 
                    <PanelHoveredRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                                        regionsToProgrammes={regionsToProgrammes}
                                        hovered={hovered} />}

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

        {/* The MODAL WINDOW for the selected project PDF */}
        { projectInModal &&
        <div className="tesim-modal-wrapper" tabIndex="-1" role="dialog" aria-hidden="true"
            onClick={e=>setProjectInModal(null)}>
            <div className="tesim-modal">
                <iframe src={ projectInModal.permalink?? allProjects.find(p=>p.ID===projectInModal).permalink }>

                </iframe>
            </div>
        </div>
        }
    </div>
</div>
    )
}

