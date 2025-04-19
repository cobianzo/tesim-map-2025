import React from "react";
import { getBaseUrl } from "../helpers/utils";

function PanelIntroENICBC() {
  return (
    <div className="eni-cbc-period-info">
      {/********** HEAD of PANEL **********/}
      <div className="TM_card-header TM_card-header--with-logo">
        <h2 className="TM_h2">ENI-CBC Period</h2>
        <div class="interreg-next-logo">
          {/* <img
            src={getBaseUrl() + "eni-cbc.png"}
            alt="ENI-CBC logo"
          /> */}
        </div>
      </div>
      {/********** END OF HEAD **********/}

      {/********** BODY of PANEL **********/}
      <div className="TM_card-body">
        <p>
          Borders may be obstacles, but also opportunities. Borders may
          separate, but they can also connect. The external borders across the
          European Union are an inspiration for people to work together and make
          the territories on both sides greener, more prosperous, more
          connected, and more inclusive. The cooperation across the EU external
          borders aims at improving the living conditions of regional
          communities, by finding common solutions to common challenges.
        </p>
      </div>
    </div>
  );
}

export default PanelIntroENICBC;
