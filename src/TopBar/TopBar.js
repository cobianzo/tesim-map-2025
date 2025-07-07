import React from 'react';
import Select from 'react-select'
import ListOfProgrammesButton from './ListOfProgrammesButton';
import { sanitizePeriodName, themeToLabel } from '../helpers/utils';

/**
 * DROPDOWN for the countries (also regions, but it was removed).
 */
export default function TopBar( {   regionsToProgrammes,
                                    allProgrammes,
                                    selectedProgramme, setSelectedProgramme,
                                    allRegionsInfo, allCountriesInfo,
                                    countryHovered,
                                    countrySelected, setCountrySelected,
                                    showProgrammesPanel,
                                    allProjects, projectInModal, setProjectInModal,
                                    selectedPeriod,
                                    appOptions, setAppOptions } ) {

    // **** STATES ****
    const [optionsProgrammes, setOptionsProgrammes] = React.useState([]);
    const [optionsCountry, setOptionsCountry] = React.useState([]);
    const [optionsProjects, setOptionsProjects] = React.useState([]); // for select all projects

    const [placeholderCountryRef, setPlaceholderCountryRef] = React.useState(null);

    // **** ON MOUNT *****
    React.useEffect(() => {

        if (!allRegionsInfo || Object.keys(allRegionsInfo).length === 0) return;
        if (!allCountriesInfo || Object.keys(allCountriesInfo).length === 0) return;
        if (!regionsToProgrammes || !regionsToProgrammes.nuts3 || Object.keys(regionsToProgrammes.nuts3).length === 0) return;
        if (!regionsToProgrammes || !regionsToProgrammes.countries || Object.keys(regionsToProgrammes.countries).length === 0) return;

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

        });
        newOptions.push(tempGroupedOptions);


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

        const PHCountry = document.querySelector('.search-by-country div[class*="placeholder"]');
        setPlaceholderCountryRef(PHCountry);

        return () => {
        // cleanup
        }
    }, [allRegionsInfo, regionsToProgrammes, allCountriesInfo, countrySelected, optionsCountry.length]);

    // Initialize the dropdown values for All Programmes
    React.useEffect( () => {
        if (!allProgrammes || !Object.keys(allProgrammes).length) return;
        const allProgrammesArray = [];
        Object.keys(allProgrammes).forEach(programmeId => {
            const label = allProgrammes[programmeId].post_title;
            const period = allProgrammes[programmeId].period;
            const add= ( selectedPeriod && period === selectedPeriod ) ?? false;
            if (add)
                allProgrammesArray.push({ label, value: programmeId}); //
        })
        setOptionsProgrammes(allProgrammesArray);
    }, [selectedPeriod, allProgrammes]);

    // Initialize the dropdown values for All projects
    React.useEffect( () => {
        if (!allProjects || !allProjects.length ) return;
        if (!allProgrammes || !Object.keys(allProgrammes).length) return;
        var groupedOptions = [];

        // to create a title we can use   { value: 'blue', label: 'Blue', color: '#0052CC', isDisabled: true },
        allProjects.forEach( proj => {
            // find the option with that label
            // we group projects by thematic, prop.color (environment, p2p, economic, infrastr)
            let period = '';
            if (allProgrammes && Object.keys(allProgrammes).length) {
                const programme = allProgrammes[proj.programme];
                period = programme.period;
            }
            if ( period && selectedPeriod && period !== selectedPeriod ) {
                return;
            }

            let thematic = proj.color;
            if (thematic.toLowerCase() === 'economical') thematic = 'Economic development';
            else if (thematic.toLowerCase() === 'infrastructures') thematic = 'Cross-border infrastructure';
            let subthematic = proj.subthematic.replace(/well functioning /ig, '');
            subthematic = subthematic.replace('&amp;', '&');
            const groupLabel = themeToLabel(`${thematic}`) + (subthematic? ' - ' + subthematic : '' );
            var groupIndex = groupedOptions.findIndex( gr => gr.label === groupLabel );
            // if (groupIndex === -1) groupIndex = groupedOptions.findIndex( gr => gr.label === proj.color );
            if (groupIndex === -1) { // not found -> create the group
                groupedOptions.push({ label: groupLabel, options: []}); // init if didnt exist
                groupIndex = groupedOptions.length - 1;
            }
            groupedOptions[groupIndex].options.push({
                label: `${proj.post_title}`,
                value: proj.ID
            });
        })

        // now sort alphabetically
        groupedOptions.sort((a, b) => a.label > b.label ? 1 : -1 );

        console.log('%c Regenrating group: ', 'font-size:2rem', selectedPeriod, groupedOptions);
        setOptionsProjects(groupedOptions);

    }, [allProjects, allProgrammes, selectedPeriod]);

    // on mount when countries info is ready
    // ===========

    React.useEffect(()=>{
        if (!placeholderCountryRef) return;
        if (!allCountriesInfo[countryHovered]) { // if the country exists updates the placeholder
            if (countrySelected) {
                placeholderCountryRef.textContent = allCountriesInfo[countrySelected].title;
                return;
            }
            placeholderCountryRef.textContent = 'Select a country';
            return;
        }
        placeholderCountryRef.textContent = allCountriesInfo[countryHovered].title;
    }, [countryHovered, allCountriesInfo, countrySelected, placeholderCountryRef]); //WATCH:countryHoveredInMap

    React.useEffect(()=>{
        if (!placeholderCountryRef || !countrySelected) {
            if (placeholderCountryRef) placeholderCountryRef.textContent = 'Select a country';
            return;
        }
        placeholderCountryRef.textContent = allCountriesInfo[countrySelected].title;
    }, [countrySelected, allCountriesInfo, placeholderCountryRef]); // WATCH:countrySelected

    React.useEffect(()=>{
        var PHProjectDropdown = document.querySelector('.search-by-project div[class*="placeholder"]')
                                || document.querySelector('.search-by-project div[class*="singleValue"]'); // if there was a value on it already.
        if (!projectInModal) {
            // remove dropdown
            if (PHProjectDropdown) {
                const selectedPeriodText = sanitizePeriodName(selectedPeriod);
                PHProjectDropdown.textContent = `Look for a project${selectedPeriodText? ` in ${selectedPeriodText} period` : ''}`;
            }
        }
    }, [projectInModal, selectedPeriod]);//WATCH:projectInModal

    // *** HANDLERS
    const handleSelectCountry = e => {
        setCountrySelected(e.value);
    }

    // *** FUNCTION HELPER
    // ... empty


    // *** T E M P L A T E ******    JXS    *******************************
    /**********************************************************************/
    return (<>

        {/* <ListOfProgrammesButton appOptions={appOptions} setAppOptions={setAppOptions}
                showProgrammesPanel={showProgrammesPanel} countryHovered={countryHovered}
                allProgrammes={allProgrammes}
                selectedProgramme={selectedProgramme}
                /> */}
        <div className='tm_nav-item search-by-programme TM_col-6 TM_col-md-3'>
            {/* { ! countrySelected && */}
            <Select options={optionsProgrammes}
                    placeholder="Lookup by Programme"
                    defaultValue={''} // I didnt find a way to change the value automatically.
                    // onInputChange={ handleSelectRegion }
                    onChange={e => {
                        setSelectedProgramme(e.value);
                        } }/>
            {/* } */}
        </div>
        <div className='tm_nav-item search-by-country TM_col-6 TM_col-md-3'>
            <Select options={optionsCountry}
                    placeholder="Lookup by country"
                    defaultValue={''} // I didnt find a way to change the value automatically.
                    // onInputChange={ handleSelectRegion }
                    onChange={handleSelectCountry}/>
        </div>
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