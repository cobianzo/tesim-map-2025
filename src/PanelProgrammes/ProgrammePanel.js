import React from "react";
import ProjectInfo from "../ProjectInfo";
import FilterByThematic from "../FilterByThematic";
import { themeToLabel, themeToProjectColor } from "../helpers/utils";
import useAlphabeticProjects from "../useAlphabeticProjects";

/**
 *
 * @param {int} programmeId : given the programme post ID, we display info and projects.
 * @returns
 */
export default function ProgrammePanel({
  programmeId,
  allProgrammes,
  allProjects,
  setProjectInModal,
  selectedPeriod
}) {
  const [filterByTheme, setFilterByTheme] = React.useState("");
  // computed list of project in alphabetic order

  const currentProjectsForProgramme = !allProjects ? [] : allProjects.filter( pro => allProgrammes[programmeId]?.projects?.includes(pro.ID) );
  const projectsInAlphabetic = useAlphabeticProjects(currentProjectsForProgramme);

  if (
    !allProgrammes[programmeId] ||
    !Object.keys(allProgrammes[programmeId]).length
  )
    return "no prog" + programmeId;
  return (
    <>

      {/* <p className="h4">{ allProgrammes[programmeId].post_title }</p> */}
      <FilterByThematic
        filterByTheme={filterByTheme}
        setFilterByTheme={setFilterByTheme}
        projects={allProgrammes[programmeId].projects}
        allProjects={allProjects}
        selectedPeriod={selectedPeriod}
      />

      <span className="badge badge-secondary d-block">
        {allProgrammes[programmeId].projects?.length} projects
      </span>

      <div className="TM_list-of-projects" data-theme={themeToLabel(filterByTheme)}>
        <ul>
          {allProgrammes[programmeId].projects ? (
            projectsInAlphabetic.map((ID) => {
              const projInfo = allProjects
                .filter(
                  (pinf) =>
                    !filterByTheme.length ||
                    themeToProjectColor(filterByTheme) === pinf?.color
                )
                .find((pro) => ID === pro.ID);
              return projInfo ? (
                <ProjectInfo
                  setProjectInModal={setProjectInModal}
                  filterByTheme={filterByTheme}
                  projectInfo={projInfo}
                  key={`pi-${ID}`}
                />
              ) : null;
            })
          ) : (
            <pre> No projects found :(</pre>
          )}
        </ul>
      </div>
    </>
  );
}
