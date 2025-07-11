import React from "react";
import ProjectInfo from "../ProjectInfo";
import { sanitizePeriodName, themeToLabel } from "../helpers/utils";
import FilterByThematic from "../FilterByThematic";
import useFilteredProgrammesForCountry from "./useFilteredProgrammesForCountry";
import useFilteredProjectsForCountry from "./useFilteredProjectsForCountry";
import InfoProgrammesAndProjectsForCountry from "./InfoProgrammesAndProjectsForCountry";
import BackPanelButton from "../BackPanelButton";

/**
 *
 * @param {} param0
 * @returns
 */

function PanelCountryContent({
  allCountriesInfo,
  allProjects,
  allProgrammes,
  countryHovered,
  countrySelected,
  setCountrySelected,
  selectedProgramme,
  filterByTheme,
  setFilterByTheme,
  setProjectInModal,
  selectedPeriod,
}) {
  const programmesForSelectedCountry = useFilteredProgrammesForCountry({
    country: countrySelected ?? countryHovered,
    allProgrammes,
    selectedPeriod,
  });
  const projectsForSelectedCountry = useFilteredProjectsForCountry({
    selectedPeriod,
    country: countrySelected ?? countryHovered,
    allProgrammes,
    allProjects,
  });

  return (
    <div className="TM_card">
      {/********** HEAD **********/}
      <div className="TM_card-header">
        {/* a country is hovered (head)  */}
        {countryHovered && selectedProgramme && (
          <h2 className="TM_h2 tm_mt-0">
            <span>
            {allCountriesInfo[countryHovered]?.title ?? "Country"} <br />
            </span>
          </h2>)}

        {/* a country is selected  */}
        {countrySelected || countryHovered ? (
          <InfoProgrammesAndProjectsForCountry
            theCountry={
              allCountriesInfo[countrySelected ?? countryHovered]?.title
            }
            programmesForSelectedCountry={programmesForSelectedCountry}
            projectsForSelectedCountry={projectsForSelectedCountry}
            selectedPeriod={selectedPeriod}
          />
        ) : null}
        {countrySelected && (
          <BackPanelButton onClickHandle={ () => { setCountrySelected(); setFilterByTheme(); } } color="secondary"/>
        )}
      </div>
      {/********** END OF HEAD **********/}

      {/********** BODY **********/}
      <div className="TM_card-body">
        {/* a country is hovered (body) */}
        {countryHovered && !countrySelected && (
          <p className="TM_text-secondary">
            {(projectsForSelectedCountry?.length > 0) ?
                `Click on the country for more information`
              : <span>No projects for this country are shown yet in this exhibition for the period  {selectedPeriod? ` for the period ${sanitizePeriodName(selectedPeriod)}` : `` }</span>}
          </p>)}

        {/* a country is selected (body) */}
        {(countrySelected && projectsForSelectedCountry) ? (
          <div className="InnerPanel-list-of-projects">

            <FilterByThematic
              filterByTheme={filterByTheme}
              setFilterByTheme={setFilterByTheme}
              projects={projectsForSelectedCountry}
              allProjects={allProjects}
              selectedPeriod={selectedPeriod}
            />
            <footer className="TM_text-secondary">
              {countrySelected && (

                  <small>
                    { projectsForSelectedCountry.length ?
                       `Click on the thumbnail to open the full description`
                        :
                        `No projects for this country are shown yet in this exhibition for the period ${sanitizePeriodName(selectedPeriod)}`
                    }
                  </small>
              )}

            </footer>
            <BackPanelButton onClickHandle={ () => { setCountrySelected(); setFilterByTheme(); } } color="gray" />

            {/* List all the projects applying all filters ( country selected, period) */}
            <div className="TM_list-of-projects" data-theme={themeToLabel(filterByTheme)}>
              <ul>
                {projectsForSelectedCountry?.length > 0 &&
                  projectsForSelectedCountry
                    .filter((projID) => {
                      if (!filterByTheme) return true;
                      const projInfo = allProjects.find(
                        (pro) => projID === pro.ID
                      );
                      return (filterByTheme === projInfo.color);
                    })
                    .map((projectId) => {
                      const projInfo = allProjects.find(
                        (pro) => projectId === pro.ID
                      );
                      return (
                        <ProjectInfo
                          key={`pp-${projectId}`}
                          setProjectInModal={setProjectInModal}
                          projectInfo={projInfo}
                        />
                      );
                    })}
              </ul>
            </div>
          </div>
        ) : null }
      </div>
    </div>
  );
}

export default PanelCountryContent;
