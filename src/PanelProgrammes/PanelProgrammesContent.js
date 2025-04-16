import React from 'react'
import PanelProgrammesSearch from './PanelProgrammesSearch'
import BackPanelButton from '../BackPanelButton'

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
        {showProgrammesPanel && (
          <PanelProgrammesSearch
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
        )}
      </div>
    </div>

  )
}

export default PanelProgrammesContent