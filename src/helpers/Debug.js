import React from "react";
import { createAnchoredTooltip } from "./debughelpers";
import "./debug.scss";

function Debug({ allCountriesInfo, countrySelected }) {
  const [textDebug, setTextDebug] = React.useState("Debug component mounted");

  // hwne clicking on a country, we create the tooltip for all regions
  // it's not handy because they overlap and you cant read them. Commented
  // React.useEffect(() => {
  //   if (countrySelected) {
  //     const allRegions = document.querySelectorAll(
  //       '[id="landmarks-' + countrySelected + '"] path'
  //     );
  //     allRegions.forEach((path) => {
  //       const numberPart = path.id.match(/\d+/)?.[0] || "";
  //       createAnchoredTooltip(path.id, numberPart);
  //     });
  //   }
  // }, [countrySelected]);
  React.useEffect(() => {
    console.info(
      "%cDebug component mounted",
      "font-size:2rem; color:pink",
      allCountriesInfo
    );

    Object.keys(allCountriesInfo).forEach((countryCode) => {
      const countryPath = document.querySelector(
        `.TM_map-wrapper svg #${countryCode}0`
      );
      if (countryPath) {
        countryPath.remove();
      }

      const allRegions = document.querySelectorAll('[id^="landmarks-"] path');

      allRegions.forEach((path) => {
        // createAnchoredTooltip(path.id, path.id);

        path.addEventListener("mouseenter", (e) => {
          setTextDebug(`Hovered region: ${path.id}`);
          path.classList.add("region-with-programme-hovered");
        });

        path.addEventListener("mouseleave", (e) => {
          setTextDebug(`not Hovered`);
          path.classList.remove("region-with-programme-hovered");
        });

        // clicking on a region saves the id in the debug text list of ids
        path.addEventListener("click", (e) => {
          const el = document.querySelector(".debug-top");
          const fixedTextDebug = el?.textContent ?? "";
          let newText =
          fixedTextDebug + (fixedTextDebug.length ? "," : "") + path.id;
          const uniqueIds = [...new Set(newText.split(',').filter(id => id))];
          newText = uniqueIds.join(',');
          path.classList.add("region-debug-selected");
          if (el) el.textContent = newText;
        });
      });
    });

    // remove transition which makes thing slower
    const container = document.getElementById("svg-map-container");
    if (container) {
      const selectables = container.querySelectorAll(".selectable");
      selectables.forEach((el) => {
        el.style.transition = "none";
      });
    }

    return () => {
      console.log("Debug component unmounted");
    };
  }, []);

  return (
    <>
      <div className="debug-top"></div>
      <div className="debug-centered">{textDebug}</div>
    </>
  );
}

export default Debug;
