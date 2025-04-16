import React from 'react'
import ProgrammesList from './ProgrammesList'
import BackPanelButton from '../BackPanelButton'
import ProgrammePanel from './ProgrammePanel'

function PanelProgrammesContent({
  periods,
  selectedPeriod,
  setSelectedPeriod,
  allProgrammes,
  allProjects,
  setProjectInModal,
  hoveredProgramme,
  setHoveredProgramme,
  selectedProgramme,
  setSelectedProgramme,
  appOptions,
  setAppOptions,
  showProgrammesPanel
}) {
  /* Panel on the left. Shows info of selected country or shows Search by programme */
  return (
    <div className="TM_card">


      <BackPanelButton onClickHandle={() => {
        setAppOptions( Object.assign( {...appOptions}, {
          showProjectsType: appOptions.showProjectsType === 'all-programmes'? 'map' : 'all-programmes'
        }))
      }} />

      {/********** HEAD of PANEL **********/}
      <div className="TM_card-header">
          {/* Show all programmes is selected and one programme is chosen */}
          {appOptions.showProjectsType === "all-programmes" &&
                (selectedProgramme ? (
          <h2 className="TM_h2">
            <b>{allProgrammes[selectedProgramme].post_title}</b>
          </h2>
          ) : (
          <h2 className="TM_h2">Select a programme</h2>
          ))}
      </div>
      {/********** END OF HEAD **********/}

      {/********** BODY of PANEL **********/}
      <div className="TM_card-body">
        {/* All programmes, or A programme is selected */}
        {selectedProgramme ?
          <div className="InnerPanel-list-of-projects">
          <BackPanelButton onClickHandle={()=> setSelectedProgramme(null)} />

          <ProgrammePanel
            setProjectInModal={setProjectInModal}
            programmeId={selectedProgramme}
            allProgrammes={allProgrammes}
            allProjects={allProjects}
          />
        </div>
        :
         showProgrammesPanel &&
          <ProgrammesList
            allProgrammes={allProgrammes}
            allProjects={allProjects}
            setProjectInModal={setProjectInModal}
            hoveredProgramme={hoveredProgramme}
            setHoveredProgramme={setHoveredProgramme}
            selectedProgramme={selectedProgramme}
            setSelectedProgramme={setSelectedProgramme}
            periods={periods}
            selectedPeriod={selectedPeriod}
            setSelectedPeriod={setSelectedPeriod}
          />
        }
      </div>
    </div>

  )
}

export default PanelProgrammesContent