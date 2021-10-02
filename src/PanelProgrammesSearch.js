import React from 'react'
import ProgrammeInfoPanel from './ProgrammeInfoPanel'
import ProgrammePanel from './ProgrammePanel';
import queryString from 'query-string';
import ProjectInfo from './ProjectInfo';

/* TODO:
when hovering a ProgrammeInfoPanel, the regions in the map are shown
when selecting a programme, the panel expands to show all projects in that programme
*/
export default function PanelProgrammesSearch({
    allProgrammes, allProjects,
    setProjectInModal,
    hoveredProgramme, setHoveredProgramme,
    selectedProgramme, setSelectedProgramme,
}) {

    // CALCULATED/INIT Programmes in alphabetical order!
    var programmesIdsAlphabetical = React.useMemo( () => 
       Object.keys(allProgrammes).sort( (a, b) => (allProgrammes[b].post_name > allProgrammes[a].post_name ? -1 : 1))
      , [ allProgrammes ] );


    // ?debug=1 > DEBUG tool. Show all projects at once so we can knwo which one is not ok.
    // -------------------   D E B U G    --------------------------------------
    if (Object.keys(queryString.parse(window.location.search)).includes('debug')) {
        return <ul className="projects-list p-0 tm_row tm_list-unstyled"> { allProjects.map( project => ( 
            <li onClick={e=> {setProjectInModal(project)}}><ProjectInfo 
            setProjectInModal={setProjectInModal} projectInfo={project}
        /></li> ) ) } </ul>;
    }
    // -------------------   end D E B U G    --------------------------------------


    if (!allProgrammes) return <p>Loading programmes</p>;
    return (<>
            {/* Show all programmes */}
            <ul className="TM_List-of-programmes">
            {  programmesIdsAlphabetical.map((code)=> (
                <li onClick={ e=> setSelectedProgramme( selectedProgramme === code? null : code) }
                    onMouseEnter={ e=> setHoveredProgramme(code) }
                    onMouseLeave={ e=> setHoveredProgramme(null) }
                    className={
                        ` ${ (selectedProgramme === code) && 'selected'}`
                    }
                >
                    <p>{allProgrammes[code].post_title}</p>
                    <img className="logo-programme" src={allProgrammes[code].logo} />
                </li>
            ))}
            </ul>

            {/* A programme is selected  */}
            { 
                selectedProgramme && (
                    <div className='InnerPanel-list-of-projects'>
                        <div className="tm_btn-wrapper" onClick={ e=>setSelectedProgramme(null)}>
                            <button className="TM_btn TM_btn-close " style={{fontSize:'2rem', paddingTop:'13px'}}>
                                 ⇠
                            </button>
                        </div>

                        <ProgrammePanel
                            setProjectInModal={setProjectInModal}
                            programmeId={selectedProgramme}
                            allProgrammes={allProgrammes}
                            allProjects={allProjects} />
                        
                    </div>
                )
            }
        </>
    )
}

