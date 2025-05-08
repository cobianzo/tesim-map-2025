import React from 'react'

import './BackPanelButton.scss';

function BackPanelButton({onClickHandle, color}) {
  return (
    <div className={`tm_btn-wrapper tm-${color}`} onClick={(e) => { onClickHandle() }}
    >
      <button className="TM_btn-close ">⇠</button>
    </div>
  )
}

export default BackPanelButton;