import React from 'react'
import ProgrammeInfoPanel from './ProgrammeInfoPanel';

export default function PanelSelectedRegion({allProgrammes,allProjects,
    allRegionsInfo, allCountriesInfo,
    regionsToProgrammes,
    regionSelected,
    appOptions,
    projectInModal, setProjectInModal
}) {

    const [regionInfo, setRegionInfo] = React.useState({});
    const [programmes, setProgrammes] = React.useState([]);
     // WATCH
     React.useEffect(() => {
        if (!allRegionsInfo || !Object.keys(allRegionsInfo).length) return;
        const regionI = allRegionsInfo[regionSelected];
        setRegionInfo(regionI);

        const progIDs = regionsToProgrammes.nuts3[regionSelected]; // [ "5431", "2334"]
        const programmes = []; // progIDs.map( progID => allProgrammes[progID] );
        progIDs?.forEach( progId => {
            const programmeInfo = allProgrammes[progId];
            let projects = programmeInfo.projects.map( projID => allProjects.find( pJ => pJ.ID === projID)); 
            programmeInfo.projectsArray = projects;
            programmes.push(programmeInfo);
        });
        setProgrammes(programmes);

        return () => {
            setProgrammes([]);
        }
    }, [regionSelected]);//WATCH:regionSelected
    // COMPUTED
    const getCountry = () => {
        if (regionInfo) {
            const countryCode = regionSelected.substr(0,2);
            const countryInfo = allCountriesInfo[countryCode];
            return countryInfo? countryInfo.title : '';
        }
    }

    return (<>
        <div className="TM_row">
            <div className="TM_col-8">
                <h2>
                    { regionInfo?.title }
                </h2>
                <p className="">
                    { getCountry() }
                </p>
                <small>
                    { programmes?.length} programmes
                </small>
            </div>
        </div>
        <div className="TM_row projects-by-programme">

        </div>

        <div className="TODELETE">
        { appOptions.showProjectsType === 'all-projects-together' ?
            <ul>
                
            </ul>
        :
            <ul className="tm_list-unstyled">
                { programmes.map( progInfo => 
                  <li key={`prog-${progInfo.ID}`}>
                      <ProgrammeInfoPanel   programmeInfo={progInfo} 
                                            projectsInfo={progInfo.projectsArray} 
                                            projectInModal={projectInModal} setProjectInModal={setProjectInModal}
                                            />
                  </li>  
                )}
            </ul>
        }
        </div>
    </>)
}

