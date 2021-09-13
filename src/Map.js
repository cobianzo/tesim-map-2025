import React from 'react'
import Europe from "./SVGEurope";


import useKeyPress from './helpers/useKeyPress';
//import Brazil from "@svg-maps/brazil";
// import "react-svg-map/lib/index.css";
import './Map.scss';
import TopBarSearch from './TopBarSearch';
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
        Object.keys( regionsToProgrammes.nuts3 ).forEach( regCode => {
            const path = refSVG.current.getElementById(regCode)
            path?.classList.add('selectable');
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
        // shabby solution
        var PHCountry = document.querySelector('.search-by-country div[class*="placeholder"]');
        if (!PHCountry) PHCountry = document.querySelector('.search-by-country div[class*="singleValue"]'); // if there was a value on it already.

        if (countrySelected && regionsToProgrammes && regionsToProgrammes.countries[countrySelected]) { 
            // first, the mode of lookup comes back to 'map'.
            setAppOptions(Object.assign( {...appOptions}, { showProjectsType: 'map' }));

            let path = refContainer.current.querySelector('.country-selected');
            if (path) path.classList.remove('country-selected');
            path = refContainer.current.querySelector('#' + countrySelected + '0'); // path#es0
            if (path) path.classList.add('country-selected');

            PHCountry.textContent = allCountriesInfo[countrySelected].title; // dropdown value needs to be changed by hand if selected from map
        }
        if (countrySelected===null){
            // cleanup the country selected in map
            if (!refContainer.current) return;
            const path = refContainer.current.querySelector('#' + countrySelected + '0'); // path#es0
            if (path) path.classList.remove('country-selected');
            // cleanup the dropdown country
            
            PHCountry.textContent = 'Select country...';
        
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
    
    /** COMPUTED : considers all the main states that this app accepts and explains it with classes in an array */    
    const currentStateClasses = React.useMemo(()=>{
        let classes = [];
        if (hovered) classes.push('region-hovered');
        if (countryHovered) classes.push('country-hovered');
        if (regionSelected) classes.push('region-selected');
        if (countrySelected) classes.push('country-selected');
        if (appOptions.showProjectsType === 'all-programmes') 
            classes.push('showing-programmes');
        if (projectInModal) classes.push('project-selected');
        return classes;    
    }, [regionSelected, countryHovered, countrySelected, appOptions.showProjectsType, projectInModal ]);

    // *** T E M P L A T E ******    JSX    *******************************
    /**********************************************************************/ 
    return (
<div    className={`TM_container ${
              currentStateClasses.length? 
                        'TM_container--active-state ' + currentStateClasses.join(' ') : 'TM_container--no-selection'
        }`} 
        ref={refContainer}>

    <div id="TM_topbar" className='TM_row'>
    
            <TopBarSearch allProgrammes={allProgrammes} allProjects={allProjects} regionsToProgrammes={regionsToProgrammes} 
                            allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo} 
                            hovered={hovered} countryHovered={countryHovered} 
                            regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                            countrySelected={countrySelected} setCountrySelected={setCountrySelected}
                            allRegionsInfo={allRegionsInfo}
                            appOptions={appOptions} setAppOptions={setAppOptions}
                            allProjects={allProjects} projectInModal={projectInModal} setProjectInModal={setProjectInModal} />
        
    </div>

    <div className="TM_row border TM_position-relative">
        
        {/* Panel on the left. Shows info of selected country or shows Search by programme */}
        <div className={`TM_left-panel `}>
            <div className="TM_card">
                <div className="TM_card-header">
                { currentStateClasses.length === 0 && <>
                    {/* Help info when nothing is selected */}
                    <h2 className="TM_h2">Programmes <span className="TM_text-primary">and</span> Projects search</h2>
                    {process.env.NODE_ENV} {process.env.REACT_APP_PUBLIC_URL} | {process.env.REACT_APP_LOCAL_ENDPOINT}
                </> }
                { countryHovered && !countrySelected && 
                    <h2 className="TM_h2 tm_mt-0"><b>{ allCountriesInfo[countryHovered].title }</b></h2>
                }
                { countrySelected && <>
                    <h2 className="TM_h2 tm_mt-0"><b>{ allCountriesInfo[countrySelected].title }</b></h2>
                    <p>{ regionsToProgrammes.countries[countrySelected].length } programme{regionsToProgrammes.countries[countrySelected].length > 1 && 's' } and <br/>
                        { countriesToProjects[countrySelected].length } project{countriesToProjects[countrySelected].length > 1 && 's' }
                        &nbsp;developing in this country.
                    </p>
                    </>
                }
                    {/* @BOOK:SELECTBYREGION not needed since we dont select region anymore
                    {regionSelected && 
                    <button onClick={ e => { setRegionSelected(null); setCountrySelected(null); }}
                        className='TM_btn TM_btn-secondary'>
                        Close selection
                    </button>} */}
                    
                </div>
                <div className="TM_card-body">
                    {/* Just info when nothing is selected */}
                    { currentStateClasses.length === 0 && <p>
                        Here you can access to the information of all ENI CBC projects. 
                        Look for them by searching in the map or using the options above.
                    </p> }
                    
                    {
                        countryHovered && !countrySelected && <>
                        <p>
                            <b>{ regionsToProgrammes.countries[countryHovered]?.length } programme{regionsToProgrammes.countries[countryHovered].length > 1 && 's' }</b> and <br/>
                            <b>{ countriesToProjects[countryHovered]?.length } project{countriesToProjects[countryHovered]?.length > 1 && 's' }</b>
                            &nbsp;developing in this country.
                        </p>
                        <p className="TM_text-secondary">
                            <br/>Click on the country to display all projects
                        </p>
                        </>
                    }


                    { countrySelected && countriesToProjects[countrySelected] && (
                        <div className='Panel-list-of-projects'>
                            <div className="tm_btn-wrapper" onClick={ e=>setCountrySelected(null)}>
                                <button className="TM_btn-close ">
                                    Close
                                </button>
                            </div>
                            <ul className="TM_list-of-projects">
                            { countriesToProjects[countrySelected].map( projectId => {
                                const projInfo = allProjects.find( pro => projectId === pro.ID );
                                return <ProjectInfo 
                                        key={`pp-${projectId}`}
                                        setProjectInModal={setProjectInModal}
                                        projectInfo={projInfo} key={`pi-${projectId}`}/>
                                }
                            ) }
                            </ul>
                    </div>)}
                    {/* @BOOK:SELECTBYREGION
                    { regionSelected && 
                    <PanelSelectedRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                        regionsToProgrammes={regionsToProgrammes}
                        regionSelected={regionSelected} setRegionSelected={setRegionSelected}
                        appOptions={appOptions}
                        projectInModal={projectInModal} setProjectInModal={setProjectInModal} />} */}
                    
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
                <footer className="TM_text-secondary">
                    { countrySelected && <>
                        <small>Click on a project to open the full description</small>
                    </>
                    }
                </footer>
            </div>
        </div>

        {/* Panel on the right: shows infor of hovered region */}
        { hovered && !regionSelected && 
                    <PanelHoveredRegion allProgrammes={allProgrammes} allProjects={allProjects} 
                                        allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
                                        regionsToProgrammes={regionsToProgrammes}
                                        hovered={hovered} />}

        {/* The MAP */}
        <div className="TM_map-wrapper TM_col-12 tm_border TM_overflow-hidden">
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
        
        {/* The footer with help information */}
        <footer>

        </footer>



        {/* The MODAL WINDOW for the selected project PDF */}
        { projectInModal &&
        <div className="tm_tesim-modal__wrapper" tabIndex="-1" role="dialog" aria-hidden="true"
            onClick={e=>setProjectInModal(null)}>
            <div className="tm_tesim-modal__inner">
                <iframe src={ projectInModal.permalink?? allProjects.find(p=>p.ID===projectInModal).permalink }>

                </iframe>
            </div>
        </div>
        }
    </div>
</div>
    )
}

