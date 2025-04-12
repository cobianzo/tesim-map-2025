import React from 'react'

function ListOfProgrammesButton({
  appOptions, setAppOptions,
  showProgrammesPanel,
  countryHovered
}) {
  return (
    <button className={`tm_nav-item TM_col-12 TM_col-md-3 TM_btn TM_btn-primary ${appOptions.showProjectsType}`}
              onClick={ e =>
                  setAppOptions( Object.assign( {...appOptions}, {
                    showProjectsType: appOptions.showProjectsType === 'all-programmes'? 'map' : 'all-programmes'
                  }))
                }>
            {showProgrammesPanel ?
                <span>Close list of programmes</span> :
                (countryHovered ? <span></span> : <span>LIST OF PROGRAMMES</span>) }
    </button>
  )
}

export default ListOfProgrammesButton