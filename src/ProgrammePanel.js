import React from "react";
import ProjectInfo from "./ProjectInfo";
import FilterByThematic from "./FilterByThematic";
import { themeToLabel, themeToProjectColor } from "./helpers/utils";

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
}) {
  const [filterByTheme, setFilterByTheme] = React.useState("");
  // computed list of project in alphabetic order
  const projectsInAlphabetic = React.useMemo(() => {
    if (!allProjects) return null;
    let projectsArray = [...allProgrammes[programmeId].projects]; // arary of ids
    return projectsArray.sort((proID_1, proID_2) => {
      const [project1, project2] = [
        allProjects.find((pp) => pp.ID === proID_1),
        allProjects.find((pp) => pp.ID === proID_2),
      ];
      var name1 = project1.post_title + project1.post_subtitle;
      var name2 = project2.post_title + project2.post_subtitle;
      if (name1 > name2) return 1;
      return -1;
    });
  }, [programmeId, allProjects]);

  if (
    !allProgrammes[programmeId] ||
    !Object.keys(allProgrammes[programmeId]).length
  )
    return "no prog" + programmeId;
  return (
    <div
      className="programme-title"
      key={`prg-${allProgrammes[programmeId].ID}`}
    >
      {/* <p className="h4">{ allProgrammes[programmeId].post_title }</p> */}
      <span className="badge badge-secondary d-block">
        {allProgrammes[programmeId].projects?.length} projects
      </span>

      <FilterByThematic
        filterByTheme={filterByTheme}
        setFilterByTheme={setFilterByTheme}
        projects={allProgrammes[programmeId].projects}
        allProjects={allProjects}
      />

      <ul
        className="TM_list-of-projects"
        data-theme={themeToLabel(filterByTheme)}
      >
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
  );
}
