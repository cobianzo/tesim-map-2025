import React from "react";
import { getBaseUrl } from "../helpers/utils";

function PanelIntroInterregNext() {
  return (
    <div className="interreg-next-period-info">
      <div className="TM_card-header TM_card-header--with-logo">
        <h2 className="TM_h2">Interreg NEXT Period</h2>
        <div class="interreg-next-logo">
          <img
            src={getBaseUrl() + "interreg-next.png"}
            alt="Interreg NEXT logo"
          />
        </div>
      </div>
      <div className="TM_card-body">
        <p>
          Borders may be obstacles, but also opportunities. Borders may separate,
          but they can also connect. The external borders across the European
          Union are an inspiration for people to work together and make the
          territories on both sides greener, more prosperous, more connected, and
          more inclusive. The cooperation across the EU external borders aims at
          improving the living conditions of regional communities, by finding
          common solutions to common challenges.
        </p>
        <div class="w-100">
          <h3 style={{ padding: 0 }}>INTERREG Next</h3>
          <ul>
            <li>
              <a
                href="#popup"
                onClick={(e) => {
                  e.preventDefault();
                  window.Boxzilla && window.Boxzilla.show(14340);
                  return false;
                }}
                title="click to open the list of countries"
                style={{
                  color: "var(--wp--preset--color--primary)",
                  textDecoration: "underline",
                }}
              >
                24 Member States and Partner Countries
              </a>
            </li>
            <li>7 Interreg NEXT programmes</li>
            <li>EUR 864 million EU funds</li>
            <li>Over 2.000 km of 5 land borders</li>
            <li>2 sea basins</li>
            <li>1 sea crossing</li>
          </ul>
        </div>
      </div>
    </div>
  );
}

export default PanelIntroInterregNext;
