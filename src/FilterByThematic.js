import React from "react";
import { themeToLabel } from "./helpers/utils";

export default function FilterByThematic({
  filterByTheme,
  setFilterByTheme,
  projects = [],
  allProjects = [],
  selectedPeriod
}) {

  // The themes are different depending on the period.
  // The `themes` are associated to the projects, the `period` to the programmes
  const themes = selectedPeriod === 'interreg-next' ?
  ["smart-growth-2025", "environment-2025", "social-inclusion-2025", "governance-2025", "border-2025"]
  :
  ["environment", "p2p", "economic", "infrastructure"]


  return (
    <ul className="tabs TM_filter-by-theme">
      {themes.map(
        (theme) => {
          const numberProjects = projects.filter((projectID) => {
            const projInfo = allProjects.find((pro) => projectID === pro.ID);
            return projInfo.color === theme;
          }).length;
          return (
            <li
              onClick={() =>
                setFilterByTheme(filterByTheme === theme ? "" : theme)
              }
              key={theme}
              className={
                (theme === filterByTheme ? "active " : "") +
                `tm_bg-${theme}-button`
              }
              data-count={numberProjects}
            >
              {themeToLabel(theme)} ({numberProjects})
            </li>
          );
        }
      )}
    </ul>
  );
}
