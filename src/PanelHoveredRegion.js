import React from 'react'

export default function PanelHoveredRegion({allProgrammes,allProjects,
                                            allRegionsInfo, allCountriesInfo,
                                            regionsToProgrammes,
                                            hovered}) {

    const [numProgProj, setNumProgProj] = React.useState({}); // { num_progs:, num_projs: }
    const [regionInfo, setRegionInfo] = React.useState({});

    // WATCH
    React.useEffect(() => {
        if (!allRegionsInfo || !Object.keys(allRegionsInfo).length) return;
        const regionI = allRegionsInfo[hovered];
        setRegionInfo(regionI);
    
        setNumProgProj(numberOfProgrammesAndProjects());

        return () => {
            
        }
    }, [hovered])
    
    // COMPUTED
    const getCountry = () => {
        if (regionInfo) {
            const countryCode = hovered.substr(0,2);
            const countryInfo = allCountriesInfo[countryCode];
            return countryInfo? countryInfo.title : '';
        }
    }
    const numberOfProgrammesAndProjects = () => {
        if (!regionInfo) return null;
        if (!regionsToProgrammes) return null;
        const progIds = regionsToProgrammes.nuts3[hovered];
        if (!progIds) return null;
        
        const projects = progIds.reduce( (prev, current) => {
            const currentProjects = allProgrammes[current].projects;
            if (!currentProjects) return prev;
            return prev + currentProjects.length;
        },0);
        return { num_progs : progIds.length, num_projs : projects }
    }


    if (!hovered) return null;
    return (<>
        <div className="row">
            <div className="col-2">
                ✴
            </div>
            <div className="col-8">
                <h2>
                    { regionInfo?.title }
                </h2>
                <small>
                    { getCountry() }
                </small>
            </div>
        </div>
        
        <div className="row">
            <div className='col-6'>
                { numProgProj?.num_progs } programmes
            </div>
            <div className='col-6'>
                { numProgProj?.num_projs } projects
            </div>
        </div>
        
    </>
    )
}