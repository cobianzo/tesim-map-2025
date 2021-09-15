import React from 'react'
import ProgrammeInfoPanel from './ProgrammeInfoPanel'
import ProgrammePanel from './ProgrammePanel';

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

    if (!allProgrammes) return <p>Loading programmes</p>;
    return (<>
            {/* Show all programmes */}
            <ul className="TM_List-of-programmes">
            {  Object.keys(allProgrammes).map((code)=> (
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

