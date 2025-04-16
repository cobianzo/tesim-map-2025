import React from 'react'

function BackPanelButton({onClickHandle}) {
  return (
    <div className="tm_btn-wrapper" onClick={(e) => { onClickHandle() }}
    >
      <button className="TM_btn-close ">⇠</button>
    </div>
  )
}

export default BackPanelButton