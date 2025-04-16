import React from "react";
import useAlphabeticProjects from "../useAlphabeticProjects";

function useFilteredProjectsForCountry({
  selectedPeriod,
  country,
  allProgrammes,
  allProjects,
}) {

  const [filteredProjects, setFilteredProjects] = React.useState([]);


  const projectsIdsInAlphabetic = useAlphabeticProjects(allProjects);
  React.useEffect(() => {
    if (!allProgrammes || !allProgrammes.length) setFilteredProjects([]);
    if (!allProjects) setFilteredProjects([]);
    if (!projectsIdsInAlphabetic) setFilteredProjects([]);

    let tempProjectsToShow = [];

    projectsIdsInAlphabetic.forEach((projectID) => {
      let validProject = true;
      const project = allProjects.find((pp) => pp.ID === projectID);
      if (!project) return;

      // const programmeForProject = allProgrammes.find(prog => prog.ID === project.programme);
      const programmeForProject = allProgrammes[project.programme];
      if (!programmeForProject) {
        validProject = false;
      }

      // filter by period
      if (selectedPeriod) {
        if (programmeForProject.period !== selectedPeriod) {
          validProject = false;
        }
      }

      // filter by country selected
      if (country) {
        const countries = project.countries.split(",");
        if (!countries.includes(country)) {
          validProject = false;
        }
      }

      if (validProject) {
        tempProjectsToShow.push(projectID);
      }
    });

    setFilteredProjects(tempProjectsToShow);

  }, [
    selectedPeriod,
    country,
    projectsIdsInAlphabetic,
    allProgrammes,
    allProjects,
  ]); // end useEffect

  return filteredProjects;
}

export default useFilteredProjectsForCountry;
