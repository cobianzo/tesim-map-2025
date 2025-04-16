import { useMemo } from "react";

//
function useAlphabeticProjects(allProjects) {
  return useMemo(() => {
    const projectIDs = allProjects.map((project) => project.ID);
    if (!projectIDs) return null;

    const sortedIDs = [...projectIDs].sort((id1, id2) => {
      const [project1, project2] = [
        allProjects.find((p) => p.ID === id1),
        allProjects.find((p) => p.ID === id2),
      ];
      if (!project1 || !project2) return 0;

      const name1 = project1.post_title + project1.post_subtitle;
      const name2 = project2.post_title + project2.post_subtitle;
      return name1.localeCompare(name2);
    });

    return sortedIDs;
  }, [allProjects]);
}

export default useAlphabeticProjects;