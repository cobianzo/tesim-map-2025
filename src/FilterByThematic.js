import React from "react";
import { themeToLabel, themeToProjectColor } from "./helpers/utils";

export default function FilterByThematic({
  filterByTheme,
  setFilterByTheme,
  projects = [],
  allProjects = [],
}) {
  return (
    <ul className="tabs TM_filter-by-theme">
      {["environment", "p2p", "economic", "infrastructure", "governance"].map(
        (theme) => {
          const numberProjects = projects.filter((projectID) => {
            const projInfo = allProjects.find((pro) => projectID === pro.ID);
            return projInfo.color === themeToProjectColor(theme);
          }).length;
          return (
            <li
              onClick={() =>
                setFilterByTheme(filterByTheme === theme ? "" : theme)
              }
              key={theme}
              className={
                (theme === filterByTheme ? "active " : "") +
                `tm_bg-${theme}-light`
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
