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
  showProgrammesPanel,
  countryHovered

}) {
  /* Panel on the left. Shows info of all programmes or a selected programme */
  return (
    <div className="TM_card">

      <div className="TM_card-header">
        { selectedProgramme && (
          <h2 className="TM_h2 tm_mt-0"><b>{
            allProgrammes[selectedProgramme] ? allProgrammes[selectedProgramme].post_title : '--'
          }</b></h2>
        )}
      </div>

      {/********** BODY of PANEL **********/}
      <div className="TM_card-body">
        {/* All programmes, or A programme is selected */}
        {selectedProgramme && !countryHovered ?
          <div className="InnerPanel-list-of-projects">
            <BackPanelButton onClickHandle={()=> { setSelectedProgramme(null); }} color="dark" />

            <ProgrammePanel
              setProjectInModal={setProjectInModal}
              programmeId={selectedProgramme}
              allProgrammes={allProgrammes}
              allProjects={allProjects}
              selectedPeriod={selectedPeriod}
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