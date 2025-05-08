import React from 'react'

// This button will be TODELETE. All programmes will be the default view
// (the homepage)

function ListOfProgrammesButton({
  appOptions, setAppOptions,
  showProgrammesPanel,
  allProgrammes,
  selectedProgramme,
  countryHovered
}) {

  const programmeName = allProgrammes[selectedProgramme]?.post_name;
  return (

    <button className={`tm_nav-item TM_col-12 TM_col-md-3 TM_btn TM_btn-primary ${appOptions.showProjectsType}`} >
              {/* onClick={ e =>
                  setAppOptions( Object.assign( {...appOptions}, {
                    showProjectsType: appOptions.showProjectsType === 'all-programmes'? 'map' : 'all-programmes'
                  }))
                }>
                  <span>🌎</span>
            {showProgrammesPanel ?
                <span>Close list of programmes</span> :
                <span>LIST OF PROGRAMMES</span>} */}
      { programmeName }
    </button>
  )
}

export default ListOfProgrammesButton