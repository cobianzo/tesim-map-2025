import React from 'react';
// import SelectSearch from 'react-select-search';
import Select from 'react-select'
//import AsyncSelect from 'react-select/async';

export default function SearchByRegion( {   regionsToProgrammes, allRegionsInfo,
                                            hovered, setSelected } ) {
    
    // **** STATES *****
    const [options, setOptions] = React.useState([]);
    const [placeholderRef, setPlaceholderRef] = React.useState(null);

    // **** ON MOUNT *****
    React.useEffect(() => {

        if (!allRegionsInfo || Object.keys(allRegionsInfo).length === 0) return;
        if (!regionsToProgrammes || Object.keys(regionsToProgrammes).length === 0) return;
        // set up options
        const newOptions = [...options];
        let tempGroupedOptions = null;
        let currentGroupCountry = null;
        Object.keys(allRegionsInfo).forEach(nuts3Code => {
            if (! (regionsToProgrammes[nuts3Code]?.length) ) return;
            const regionInfo = allRegionsInfo[nuts3Code];
            const countryCode = nuts3Code.substr(0,2);  // Array.from(nuts3Code).filter( c => (c < '0' || c > '9') ).join('')
            if (currentGroupCountry !== countryCode) {
                if (tempGroupedOptions) newOptions.push(tempGroupedOptions);
                tempGroupedOptions = { label: countryCode, options: [] }; // init
                currentGroupCountry = countryCode;
            } 
            tempGroupedOptions.options.push({label: regionInfo.title, value: nuts3Code});
            
            // if (regionsToProgrammes[nuts3Code]?.length) {
            //     newOptions.push({label: regionInfo.title, value: nuts3Code});
            // }
        });
        newOptions.push(tempGroupedOptions);
        setOptions(newOptions);

        // shabby solution to access to the placeholder. I can't find another way as it is part of a library.
        const PH = document.querySelector('.search-by-region div[class*="placeholder"]');
        setPlaceholderRef(PH);

        return () => {
        // cleanup
        }
    }, [allRegionsInfo, regionsToProgrammes]);

    // ** WATCH hovered, update (modo cutre) el placeholder del select.
    React.useEffect(()=>{
        if (!placeholderRef) return;
        if (!allRegionsInfo[hovered]) {
            placeholderRef.textContent = 'Select a region';
            return;
        }
        placeholderRef.textContent = allRegionsInfo[hovered].title;
    }, [hovered]);

    // *** HANDLERS
    const handleSelectRegion = e => {
        setSelected(e.value);
    }

    // *** FUNCTION HELPER
    // ... empty

    return (
        <div className='search-by-region'>
            
            <Select options={options} 
                    placeholder="Lookup by region name" 
                    defaultValue={hovered}
                    // onInputChange={ handleSelectRegion }
                    onChange={handleSelectRegion}/>
            

        </div>
    )
}