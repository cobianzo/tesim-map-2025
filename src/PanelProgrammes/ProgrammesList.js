import React from "react";
import DebugShowAllProgrammes from "./DebugShowAllProgrammes";
import TogglePill from "../TogglePill";



/* TODO:
when hovering a ProgrammeInfoPanel, the regions in the map are shown
when selecting a programme, the panel expands to show all projects in that programme
*/
export default function ProgrammesList({
  allProgrammes,
  allProjects,
  setProjectInModal,
  setHoveredProgramme,
  selectedProgramme,
  setSelectedProgramme,
  periods,
  selectedPeriod, setSelectedPeriod
}) {
  // CALCULATED/INIT Programmes in alphabetical order!
  var programmesIdsAlphabetical = React.useMemo(
    () =>
      Object.keys(allProgrammes).sort((a, b) =>
        allProgrammes[b].post_name > allProgrammes[a].post_name ? -1 : 1
      ),
    [allProgrammes]
  );

  if (!allProgrammes) return <p>Loading programmes</p>;
  if (!periods) return <p>Loading programmes</p>;
  return (
    <>
      <DebugShowAllProgrammes setProjectInModal={setProjectInModal} allProjects={allProjects} />

      {/* Show all programmes by period (eni-cbc and interreg-next periods */}
      <div className={`TM_Programmes-list-by-period ${selectedPeriod? "selected-period" : '' } ${selectedPeriod}`}>
        {Array.from(periods).length > 1 &&
          Array.from(periods).map((period) => (
            <div className={`${selectedPeriod === period ? "active" : ""}`}>
              <h3>{period.toUpperCase().replace(/-/g, " ")}</h3>
              <ul className={`TM_List-of-programmes`}>
              {programmesIdsAlphabetical
                .filter((code) => allProgrammes[code].period === period)
                .map((code) => (

                    <li
                      onClick={(e) =>
                        setSelectedProgramme(
                          selectedProgramme === code ? null : code
                        )
                      }
                      onMouseEnter={(e) => setHoveredProgramme(code)}
                      onMouseLeave={(e) => setHoveredProgramme(null)}
                      key={code}
                      className={` ${selectedProgramme === code && "selected"}`}
                    >
                      <p>{allProgrammes[code].post_title}</p>
                      <img
                        className="logo-programme"
                        src={allProgrammes[code].logo}
                        alt={allProgrammes[code].post_title || "Programme logo"}
                      />
                    </li>
                ))}
              </ul>
            </div>
          ))}
      </div>
    </>
  );
}
