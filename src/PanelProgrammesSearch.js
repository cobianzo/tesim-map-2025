import React, { useEffect } from "react";
import ProgrammeInfoPanel from "./ProgrammeInfoPanel";
import ProgrammePanel from "./ProgrammePanel";
import queryString from "query-string";
import ProjectInfo from "./ProjectInfo";

/* TODO:
when hovering a ProgrammeInfoPanel, the regions in the map are shown
when selecting a programme, the panel expands to show all projects in that programme
*/
export default function PanelProgrammesSearch({
  allProgrammes,
  allProjects,
  setProjectInModal,
  hoveredProgramme,
  setHoveredProgramme,
  selectedProgramme,
  setSelectedProgramme,
}) {
  const [periods, setPeriods] = React.useState([]);
  const [selectedPeriod, setSelectedPeriod] = React.useState("");
  // CALCULATED/INIT Programmes in alphabetical order!
  var programmesIdsAlphabetical = React.useMemo(
    () =>
      Object.keys(allProgrammes).sort((a, b) =>
        allProgrammes[b].post_name > allProgrammes[a].post_name ? -1 : 1
      ),
    [allProgrammes]
  );

  // Calculate the periods. It will come out with ['eni-cbc', 'interreg-next'].
  useEffect(() => {
    if (!allProgrammes || !Object.keys(allProgrammes).length) return;
    const periods = new Set();
    Object.keys(allProgrammes).forEach((programmeID) => {
      const programme = allProgrammes[programmeID];
      if (!periods.has(programme.period)) {
        periods.add(programme.period);
      }
    });
    setPeriods(periods);
  }, [allProgrammes, setPeriods]);

  // ?debug=1 > DEBUG tool. Show all projects at once so we can knwo which one is not ok.
  // -------------------   D E B U G    --------------------------------------
  if (
    Object.keys(queryString.parse(window.location.search)).includes("debug")
  ) {
    return (
      <ul className="projects-list p-0 tm_row tm_list-unstyled">
        {allProjects.map((project) => (
          <li
            onClick={(e) => {
              setProjectInModal(project);
            }}
          >
            <ProjectInfo
              setProjectInModal={setProjectInModal}
              projectInfo={project}
            />
          </li>
        ))}{" "}
      </ul>
    );
  }
  // -------------------   end D E B U G    --------------------------------------

  if (!allProgrammes) return <p>Loading programmes</p>;
  return (
    <>
      {periods.size > 1 && (
        <div class="flex-row">
          <div>Periods</div>
          <ul className="tabs TM_filter-by-period">
            <li
              key={"all-periods"}
              className={`TM_Period TM_Period__all ${
                "" === selectedPeriod ? "active" : ""
              }`}
              onClick={() => setSelectedPeriod("")}
            >
              All
            </li>
            {Array.from(periods).map((period) => (
              <li
                key={period}
                className={`TM_Period TM_Period__${period} ${
                  period === selectedPeriod ? "active" : ""
                }`}
                onClick={() => setSelectedPeriod(period)}
              >
                {period.toUpperCase().replace(/-/g, " ")}
              </li>
            ))}
          </ul>
        </div>
      )}
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

      {/* A programme is selected  */}
      {selectedProgramme && (
        <div className="InnerPanel-list-of-projects">
          <div
            className="tm_btn-wrapper"
            onClick={(e) => setSelectedProgramme(null)}
          >
            <button
              className="TM_btn TM_btn-close "
              style={{ fontSize: "2rem", paddingTop: "13px" }}
            >
              ⇠
            </button>
          </div>

          <ProgrammePanel
            setProjectInModal={setProjectInModal}
            programmeId={selectedProgramme}
            allProgrammes={allProgrammes}
            allProjects={allProjects}
          />
        </div>
      )}
    </>
  );
}
