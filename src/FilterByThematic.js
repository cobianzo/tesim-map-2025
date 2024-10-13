import React from "react";
import { themeToLabel } from "./helpers/utils";

export default function FilterByThematic({ filterByTheme, setFilterByTheme }) {
  return (
    <ul className="tabs TM_filter-by-theme">
      {["environment", "p2p", "economic", "infrastructure", "governance"].map(
        (theme) => (
          <li
            onClick={() =>
              setFilterByTheme(filterByTheme === theme ? "" : theme)
            }
            key={theme}
            className={
              (theme === filterByTheme ? "active " : "") +
              `tm_bg-${theme}-light`
            }
          >
            {themeToLabel(theme)}
          </li>
        )
      )}
    </ul>
  );
}
