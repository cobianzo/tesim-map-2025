import React from 'react';
// import SelectSearch from 'react-select-search';
import Select from 'react-select'
//import AsyncSelect from 'react-select/async';

export default function SearchByRegion( {   regionsToProgrammes, 
                                            allRegionsInfo, allCountriesInfo,
                                            hovered, selected, setSelected,
                                            countrySelected, setCountrySelected } ) {
    
    // **** STATES *****
    const [options, setOptions] = React.useState([]);
    const [optionsCountry, setOptionsCountry] = React.useState([]);
    const [placeholderRef, setPlaceholderRef] = React.useState(null);
    const [placeholderCountryRef, setPlaceholderCountryRef] = React.useState(null);

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
        // Object.keys(allRegionsInfo).forEach(nuts3Code => {  // this for all regions, including the ones without programmes.
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
                const label = allCountriesInfo[countryCode].title;
                tempGroupedOptions = { label, options: [] }; // init to empty list of regions
                currentGroupCountry = countryCode;

                allCountriesArray.push({ label, value: countryCode}); // 
            } 
            tempGroupedOptions.options.push({label: regionInfo.title, value: nuts3Code});
            
            // if (regionsToProgrammes[nuts3Code]?.length) {
            //     newOptions.push({label: regionInfo.title, value: nuts3Code});
            // }
        });
        newOptions.push(tempGroupedOptions);
        setOptions(newOptions);

        /*  --------------
            END OF options for search for region (nuts3)
            START of options for search by country
        */
    //    if (optionsCountry.length) return; //it was already initialized, so dont repeat.
    //     const newOptionsCountry = [...optionsCountry];
    //     Object.keys(allCountriesInfo).forEach( countryCode => {
    //         newOptionsCountry.push({ label: allCountriesInfo[countryCode].title, value: countryCode });
    //     } );
        if (!optionsCountry.length) // we want this to be set only once and nevre change.
            setOptionsCountry(allCountriesArray);
        /** ------ ------ ------ ------ ------ ------  */



        // shabby solution to access to the placeholder. I can't find another way as it is part of a library.
        const PH = document.querySelector('.search-by-region div[class*="placeholder"]');
        setPlaceholderRef(PH);

        const PHCountry = document.querySelector('.search-by-country div[class*="placeholder"]');
        setPlaceholderCountryRef(PHCountry);





        return () => {
        // cleanup
        }
    }, [allRegionsInfo, regionsToProgrammes, allCountriesInfo, countrySelected]);
    
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
    }, [hovered]);

    React.useEffect(()=>{
        if (!placeholderRef || !selected) return;
        placeholderRef.textContent = allRegionsInfo[selected].title;
    }, [selected]);
    React.useEffect(()=>{
        if (!placeholderCountryRef || !countrySelected) return;
        placeholderCountryRef.textContent = allCountriesInfo[countrySelected].title;
    }, [countrySelected]);


    // *** HANDLERS
    const handleSelectRegion = e => {
        setSelected(e.value);
    }
    const handleSelectCountry = e => {
        setCountrySelected(e.value);
    }

    // *** FUNCTION HELPER
    // ... empty

    return (<>
        <div className='search-by-country col-6 col-md-4'>
            <Select options={optionsCountry} 
                    placeholder="Lookup by country" 
                    defaultValue={''}
                    // onInputChange={ handleSelectRegion }
                    onChange={handleSelectCountry}/>
        </div>
        <div className='search-by-region col-6 col-md-4'>
            <Select options={options} 
                    placeholder="Lookup by region name" 
                    defaultValue={hovered}
                    // onInputChange={ handleSelectRegion }
                    onChange={handleSelectRegion}/>
        </div>
        </>
    )
}