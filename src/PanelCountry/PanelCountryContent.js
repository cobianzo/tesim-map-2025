import React, { useEffect } from "react";
import ProjectInfo from "../ProjectInfo";
import { themeToLabel, themeToProjectColor } from "../helpers/utils";
import FilterByThematic from "../FilterByThematic";
import { useMemo } from "react";

/**
 *
 * @param {} param0
 * @returns
 */

function PanelCountryContent({
  allCountriesInfo,
  allProjects,
  allProgrammes,
  countriesToProjects,
  regionsToProgrammes,
  countryHovered,
  countrySelected,
  setCountrySelected,
  filterByTheme,
  setFilterByTheme,
  setProjectInModal,
  projectsInAlphabetic,
  periods, selectedPeriod
}) {

  const [projectsForSelectedCountry, setProjectsForSelectedCountry] = React.useState([]);

  // Computed
  const selectedCountryInfo = useMemo(() => {
    return countrySelected ? allCountriesInfo[countrySelected] : null;
  }, [countrySelected, allCountriesInfo]);

  useEffect( () => {
    if (!allProgrammes) return;
    if (!allProjects) return;
    if (!projectsInAlphabetic) return;
    console.log('todelete', projectsInAlphabetic);
    let tempProjectsToShow = [];
    projectsInAlphabetic.forEach(projectID => {
      let validProject = true;
      const project = allProjects.find((pp) => pp.ID === projectID);
      if (!project) return;

      const programmeForProject = allProgrammes[project.programme];

      // filter by thematic button
      if (filterByTheme.length) {
        const projectThemes = project.themes || [];
        if (!filterByTheme.some((theme) => projectThemes.includes(theme))) {
          validProject = false;
        }
      }

      // filter by period eni-cbc or interreg-next
      if (selectedPeriod) {
        if (programmeForProject && programmeForProject.period !== selectedPeriod) {
          validProject = false;
        }
      }

      // filter by country selected
      if (countrySelected) {
        const countries = project.countries.split(',');
        if (!countries.includes(countrySelected)) {
          validProject = false;
        }
      }

      if (validProject) {
        tempProjectsToShow.push(projectID);
      }

    });

    setProjectsForSelectedCountry(tempProjectsToShow);

  }, [selectedPeriod, countrySelected, filterByTheme, projectsInAlphabetic, allProgrammes, allProjects] );


  return (
    <div className="TM_card">

      {/********** HEAD **********/}
      <div className="TM_card-header">
        {/* a country is hovered */}
        {countryHovered && !countrySelected && (
          <h2 className="TM_h2 tm_mt-0">
            <b>{allCountriesInfo[countryHovered]?.title}</b>
          </h2>
        )}

        {/* a country is selected  */}
        {countrySelected && (
          <>
            <h2 className="TM_h2 tm_mt-0">
              <b>{selectedCountryInfo?.title}</b>
            </h2>
            {regionsToProgrammes.countries[countrySelected].length && (
              <p>
                Participating in {
                  regionsToProgrammes.countries[countrySelected].filter(
                    (pp) => pp.length
                  ).length
                }
                Programme {
                  regionsToProgrammes.countries[countrySelected].length > 1 &&
                  "s"}
                :
                {regionsToProgrammes.countries[countrySelected].map(
                  (code, i) => (
                    <b key={`pro-${i}`}>
                      {i > 0 && "; "} {allProgrammes[code].post_title}
                    </b>
                  )
                )}
                <br />
                {countriesToProjects[countrySelected]?.length ? (
                  <span>
                    <b>{countriesToProjects[countrySelected].length}</b>
                    {countriesToProjects[countrySelected].length > 1 ? (
                      <><b>projects</b> are </>
                    ) : (
                      <><b>project</b> is </>
                    )}
                    &nbsp; shown in this exhibition
                  </span>
                ) : (
                  allCountriesInfo[countrySelected] && (
                    <span><br />Engaged in ENI CBC projects outside this exhibition</span>
                  )
                )}
              </p>
            )}
            <div
              className="tm_btn-wrapper"
              onClick={(e) => setCountrySelected(null)}
            >
              <button className="TM_btn-close ">⇠</button>
            </div>
          </>
        )}
      </div>
      {/********** END OF HEAD **********/}

      {/********** BODY **********/}
      <div className="TM_card-body">
        {/* a country is hovered (body) */}
        {countryHovered && !countrySelected && (
          <>
            <p>
              Participating in <b>
                { regionsToProgrammes.countries[countryHovered].filter(
                    (pp) => pp.length
                  ).length } Programme{regionsToProgrammes.countries[countryHovered].length > 1 && "s"}
              </b>
              <br />
              {countriesToProjects[countryHovered]?.length ? (
                <span>
                  <b>{countriesToProjects[countryHovered].length}</b>
                  {countriesToProjects[countryHovered].length > 1 ? (
                    <> <b>projects</b> are</>
                  ) : (
                    <> <b>project</b> is</>
                  )}
                  &nbsp; shown in this exhibition
                </span>
              ) : (
                allCountriesInfo[countryHovered] && (
                  <span>
                    <br />
                    Engaged in ENI CBC projects outside this exhibition
                  </span>
                )
              )}
            </p>
            <p className="TM_text-secondary">
              {countriesToProjects[countryHovered]?.length && (
                <>
                  <br />
                  Click on the country for more information
                </>
              )}
            </p>
          </>
        )}

        {/* a country is selected (body) */}
        {countrySelected && countriesToProjects[countrySelected] && (
          <div className="InnerPanel-list-of-projects">
            <FilterByThematic
              filterByTheme={filterByTheme}
              setFilterByTheme={setFilterByTheme}
              projects={countriesToProjects[countrySelected]}
              allProjects={allProjects}
            />
            <footer className="TM_text-secondary">
              {countrySelected && countriesToProjects[countrySelected] && (
                <>
                  <small>Click on the icon to open the full description</small>
                </>
              )}
            </footer>
            <div
              className="tm_btn-wrapper"
              onClick={(e) => setCountrySelected(null)}
            >
              <button className="TM_btn-close ">⇠</button>
            </div>
            <ul
              className="TM_list-of-projects"
              data-theme={themeToLabel(filterByTheme)}
            >
              {projectsForSelectedCountry.map((projectId) => {
                const projInfo = allProjects.find(
                  (pro) => projectId === pro.ID
                );
                return  (
                  <ProjectInfo
                    key={`pp-${projectId}`}
                    setProjectInModal={setProjectInModal}
                    projectInfo={projInfo}
                  />
                );
              })}
            </ul>
          </div>
        )}
      </div>
    </div>
  );
}

export default PanelCountryContent;
