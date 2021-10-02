import React from 'react';
import Select from 'react-select'

/**
 * DROPDOWN for the countries (also regions, but it was removed).
 */
export default function TopBarSearch( {   regionsToProgrammes, 
                                            allRegionsInfo, allCountriesInfo,
                                            hovered, countryHovered,
                                            selected, setRegionSelected,
                                            countrySelected, setCountrySelected,
                                            allProjects, projectInModal, setProjectInModal,
                                            appOptions, setAppOptions } ) {
    
    // **** STATES *****
    const [optionsRegionsByCountry, setOptionsRegionsByCountry] = React.useState([]); // not in use anymore. It works though
    const [optionsCountry, setOptionsCountry] = React.useState([]);
    const [optionsProjects, setOptionsProjects] = React.useState([]); // for select all projects
    // const [optionsProjectsEnvironment, setOptionsProjectsEnvironment] = React.useState([]); // for select all projects
    // const [optionsProjectsEconomic, setOptionsProjectsEconomic] = React.useState([]); // for select all projects
    // const [optionsProjectsP2p, setOptionsProjectsP2p] = React.useState([]); // for select all projects
    // const [optionsProjectsInfrastructures, setOptionsProjectsInfrastructures] = React.useState([]); // for select all projects

    const [placeholderRef, setPlaceholderRef] = React.useState(null); // works better the shabby solution used for dropdown project.
    const [placeholderCountryRef, setPlaceholderCountryRef] = React.useState(null);
    // const [placeholderProjectRef, setPlaceholderProjectRef] = React.useState(null);
    

    // **** ON MOUNT *****
    React.useEffect(() => {

        if (!allRegionsInfo || Object.keys(allRegionsInfo).length === 0) return;
        if (!allCountriesInfo || Object.keys(allCountriesInfo).length === 0) return;
        if (!regionsToProgrammes || !regionsToProgrammes.nuts3 || Object.keys(regionsToProgrammes.nuts3).length === 0) return;
        if (!regionsToProgrammes || !regionsToProgrammes.countries || Object.keys(regionsToProgrammes.countries).length === 0) return;
        // if (options.length) return; //it was already initialized, so dont repeat.
        // if (optionsCountry.length) return; //it was already initialized, so dont repeat.
        
        // set up options
        const newOptions = [];
        const allCountriesArray = []; // [es, it ... ]
        let tempGroupedOptions = null;
        let currentGroupCountry = null;
        // --------------

        Object.keys(regionsToProgrammes.nuts3).forEach(nuts3Code => {
            if (! (regionsToProgrammes.nuts3[nuts3Code]?.length) ) return;

            const countryCode = nuts3Code.substr(0,2);  // Array.from(nuts3Code).filter( c => (c < '0' || c > '9') ).join('')
            // with this, if a country is selected, we show only regions of that country.
            if (countrySelected) {
                if (countryCode !== countrySelected) return;
            }

            const regionInfo = allRegionsInfo[nuts3Code];
            
            if (currentGroupCountry !== countryCode) { 
                // change of country group. init.
                if (tempGroupedOptions) {
                    newOptions.push(tempGroupedOptions); // add it to the Select
                }
                const label = allCountriesInfo[countryCode]?.title;
                tempGroupedOptions = { label, options: [] }; // init to empty list of regions
                currentGroupCountry = countryCode;

                allCountriesArray.push({ label, value: countryCode}); // 
            } 
            tempGroupedOptions.options.push({label: regionInfo?.title, value: nuts3Code});
            
            // if (regionsToProgrammes[nuts3Code]?.length) {
            //     newOptions.push({label: regionInfo.title, value: nuts3Code});
            // }
        });
        newOptions.push(tempGroupedOptions);
        setOptionsRegionsByCountry(newOptions);

        /*  --------------
            END OF options for search for region (nuts3)
            START of options for search by country
        */
    
        
        
        // eliminate duplicates
        var allCountriesArrayUnique = [];
        allCountriesArrayUnique = allCountriesArray.filter((thing, index, self) =>
            thing.label && (index === self.findIndex((t) => ( t.label === thing.label )))
        );
        // sort alphabetically
        allCountriesArrayUnique.sort((a,b) => (a.label > b.label) ? 1 : ((b.label > a.label) ? -1 : 0));
        if (!optionsCountry.length) // we want this to be set only once and never change.
            setOptionsCountry(allCountriesArrayUnique); // [ {label:Bulgaria, value:bg}, { ...} ]
        /** ------ ------ ------ ------ ------ ------  */



        // shabby solution to access to the placeholder. I can't find another way as it is part of a library.
        const PH = document.querySelector('.search-by-region div[class*="placeholder"]');
        setPlaceholderRef(PH);

        const PHCountry = document.querySelector('.search-by-country div[class*="placeholder"]');
        setPlaceholderCountryRef(PHCountry);

        // const PHProject = document.querySelector('.search-by-project div[class*="placeholder"]');
        // setPlaceholderProjectRef(PHProject);





        return () => {
        // cleanup
        }
    }, [allRegionsInfo, regionsToProgrammes, allCountriesInfo, countrySelected]);
    
    // Initialize the dropdown values for All proyects
    React.useEffect( () => {
        if (!allProjects || !allProjects.length ) return;
        if (optionsProjects.length) return;
        var groupedOptions = [];
        
        // to create a title we can use   { value: 'blue', label: 'Blue', color: '#0052CC', isDisabled: true },
        allProjects.forEach( proj => {
            // find the option with that label 
            // we group projects by thematic, prop.color (environment, p2p, economic, infrastr)
            let thematic = proj.color;
            if (thematic.toLowerCase() === 'economical') thematic = 'Economic development';
            else if (thematic.toLowerCase() === 'infrastructures') thematic = 'Cross-border infrastructure';
            const groupLabel = `${thematic}` + (proj.subthematic? ' - ' + proj.subthematic : '' ).replace('&amp;', '&');
            var groupIndex = groupedOptions.findIndex( gr => gr.label === groupLabel );
            // if (groupIndex === -1) groupIndex = groupedOptions.findIndex( gr => gr.label === proj.color );
            if (groupIndex === -1) { // not found -> create the group
                groupedOptions.push({ label: groupLabel, options: []}); // init if didnt exist
                groupIndex = groupedOptions.length - 1;
            }
            groupedOptions[groupIndex].options.push({
                label: proj.post_title,
                value: proj.ID
            });
        })
        // now sort alphabetically
        groupedOptions.forEach( (grouped, i) => {
            grouped.options.sort((a, b) => a.label.localeCompare(b.label))
        });

        setOptionsProjects(groupedOptions);
        // 4 different selects. - we dont use it in the end
        // if (groupedOptions[0]?.options)
        //     setOptionsProjectsInfrastructures(groupedOptions[0].options);
        // if (groupedOptions[1]?.options)
        //     setOptionsProjectsEnvironment(groupedOptions[1].options);
        // if (groupedOptions[2]?.options)
        //     setOptionsProjectsP2p(groupedOptions[2].options);
        // if (groupedOptions[3]?.options)
        //     setOptionsProjectsEconomic(groupedOptions[3].options);
    }, [allProjects]);

    // on mount when countries info is ready


    // ** WATCH hovered, update (modo cutre) el placeholder del select (acessing the dom)
    React.useEffect(()=>{
        if (!placeholderRef) return;
        if (!allRegionsInfo[hovered]) {
            if (selected) {
                placeholderRef.textContent = allRegionsInfo[selected].title;
                return    
            }
            placeholderRef.textContent = 'Select a region';
            return;
        }
        placeholderRef.textContent = allRegionsInfo[hovered].title;
    }, [hovered]);//WATCH:hovered in map
    React.useEffect(()=>{
        if (!placeholderCountryRef) return;
        if (!allCountriesInfo[countryHovered]) { // if the country exists
            if (countrySelected) {
                placeholderCountryRef.textContent = allCountriesInfo[countrySelected].title;
                return;  
            }
            placeholderCountryRef.textContent = 'Select a country';
            return;
        }
        placeholderCountryRef.textContent = allCountriesInfo[countryHovered].title;
    }, [countryHovered]);//WATCH:countryHoveredInMap

    React.useEffect(()=>{
        if (!placeholderRef || !selected) return;
        if (!allRegionsInfo[selected]) return;
        placeholderRef.textContent = allRegionsInfo[selected].title;
    }, [selected]);
    React.useEffect(()=>{
        if (!placeholderCountryRef || !countrySelected) {
            if (placeholderCountryRef) placeholderCountryRef.textContent = '';
            return;
        }
        placeholderCountryRef.textContent = allCountriesInfo[countrySelected].title;
    }, [countrySelected]);

    React.useEffect(()=>{
        var PHProjectDropdown = document.querySelector('.search-by-project div[class*="placeholder"]')
                                || document.querySelector('.search-by-project div[class*="singleValue"]'); // if there was a value on it already.
        if (!projectInModal) {
            // remove dropdown
            if (PHProjectDropdown) {
                PHProjectDropdown.textContent = 'Look for a project';
            }
        }
    }, [projectInModal]);//WATCH:projectInModal

    // *** HANDLERS
    // const handleSelectRegion = e => { setRegionSelected(e.value); }
    const handleSelectCountry = e => {
        setRegionSelected(null); 
        setCountrySelected(e.value);
    }

    // *** FUNCTION HELPER
    // ... empty


    // *** T E M P L A T E ******    JXS    *******************************
    /**********************************************************************/     
    return (<>

        <button className={`tm_nav-item TM_col-12 TM_col-md-3 TM_btn TM_btn-primary ${appOptions.showProjectsType}`}
              onClick={ e => 
                  setAppOptions( Object.assign( {...appOptions}, {
                    showProjectsType: appOptions.showProjectsType === 'all-programmes'? 'map' : 'all-programmes'
                  }))
                }>
            {appOptions.showProjectsType === 'all-programmes' ? 
          <span>Close list of programmes</span>: <span>LIST OF 15 ENI CBC PROGRAMMES</span>}
        </button>

        <div className='tm_nav-item search-by-country TM_col-6 TM_col-md-3'>
            <Select options={optionsCountry} 
                    placeholder="Lookup by country" 
                    defaultValue={''} // I didnt find a way to change the value automatically.
                    // onInputChange={ handleSelectRegion }
                    onChange={handleSelectCountry}/>
        </div>
        {/* <div className='search-by-region TM_col-6 TM_col-md-4'>
            <Select options={optionsRegionsByCountry} 
                    placeholder="Lookup by region name" 
                    defaultValue={hovered}
                    // onInputChange={ handleSelectRegion }
                    onChange={null}/>
        </div> */}
        <div className='tm_nav-item search-by-project TM_col-6 TM_col-md-3'>
            <Select options={optionsProjects} 
                    placeholder="Lookup by project" 
                    defaultValue={projectInModal}
                    styles={ {groupHeading: (styles) => Object.assign({ ...styles }, { 
                                                    fontSize: '22px',
                                                    background: 'gray',
                                                    color: 'white'
                                                }) }}
                    // onInputChange={ handleSelectRegion }
                    onChange={ e => setProjectInModal(e.value) }/>
        </div>

        {/* { Dropdown for every thematic - we dont want this in the end
        <div className='tm_nav-item search-by-project TM_col-6 TM_col-md-3'>
            <Select options={optionsProjectsEnvironment} 
                    placeholder="Environment projects" 
                    defaultValue={null}
                    // onInputChange={ handleSelectRegion }
                    onChange={ e => setProjectInModal(e.value) }/>
        </div> */}
        
        {/* reg hover <b>{ hovered}</b> //
        reg sel <b>{ selected}</b> //
        country hob <b>{ countryHovered}</b> //
        country sel <b>{ countrySelected}</b> // */}
        </>
    )
}