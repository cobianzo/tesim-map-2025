import React from "react";

function PanelIntroDefault() {
  return (
    <div className="no-period-info">
      {/********** HEAD of PANEL **********/}
      <div className="TM_card-header">
        <>
          {/* Help info when nothing is selected */}
          <h2 className="TM_h2">Search by programme, country or project</h2>
        </>
      </div>
      {/********** END OF HEAD **********/}

      {/********** BODY of PANEL **********/}
      <div className="TM_card-body">
        <p>
          Here you can access information about the ENI CBC projects portrayed
          in this exhibition: select them using the above options, or directly
          passing your mouse on the map to the right
        </p>
      </div>
    </div>
  );
}

export default PanelIntroDefault;
