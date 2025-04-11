import React from 'react'
import ProjectInfo from '../ProjectInfo';
import queryString from "query-string";

function DebugShowAllProgrammes({
  setProjectInModal,
  allProjects
}) {
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

  return null;
}

export default DebugShowAllProgrammes