import React from "react";
import Europe from "./SVGEurope";

import useKeyPress from "./helpers/useKeyPress";
import {
  applyClassToRegions,
  cleanupClassRegions,
  getBaseUrl,
  removeHighlightForCountriesHighlightedBySelectedProgramme,
  updatePlaceHolderCountryDropdown,
  updatePlaceHolderProgrammeDropdown,
} from "./helpers/utils";

import "./Map.scss";
import "./Panels.scss";

import TopBar from "./TopBar/TopBar";
import PanelProgrammesContent from "./PanelProgrammes/PanelProgrammesContent";
import PanelCountryContent from "./PanelCountry/PanelCountryContent";
import TogglePill from "./TogglePill";
import BackPanelButton from "./BackPanelButton";
import PanelIntroInterregNext from "./PanelIntro/PanelIntroInterregNext";
import PanelIntroDefault from "./PanelIntro/PanelIntroDefault";
import PanelIntroENICBC from "./PanelIntro/PanelIntroENICBC";
import Debug from "./helpers/Debug";

export default function Map({
  allProgrammes,
  allProjects,
  allRegionsInfo,
  allCountriesInfo,
  regionsToProgrammes,
  countriesToProjects,
  appOptions,
  setAppOptions,
  isDebug,
}) {
  const classSelectablePath = "cls-2";

  // **** STATES *****
  const refContainer = React.useRef();
  const refSVG = React.useRef();
  const [countryHovered, setCountryHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
  const [hovered, setHovered] = React.useState(null); // ID of region hovered: from here we calculat the programmes, and the projects
  const [countrySelected, setCountrySelected] = React.useState(null); // ID of region selected.
  const [projectInModal, setProjectInModal] = React.useState(null);
  const [filterByTheme, setFilterByTheme] = React.useState("");
  const [periods, setPeriods] = React.useState([]); // eni-cbc | interreg-next
  const [selectedPeriod, setSelectedPeriod] = React.useState("interreg-next");

  // State for Mode search by programme
  const [hoveredProgramme, setHoveredProgramme] = React.useState(null);
  const [selectedProgramme, setSelectedProgramme] = React.useState(null);

  // **** ON MOUNT *****
  React.useEffect(() => {
    if (selectedPeriod) {
      setFilterByTheme(null);
      setSelectedProgramme(null);

      // by hand:  we deactivate russian and belrus in Interreg Next period
      if (selectedPeriod === "interreg-next") {
        // remove the countries from the map
        const countriesToRemove = ["ru", "by"];
        countriesToRemove.forEach((countryCode) => {
          const path = refSVG.current.getElementById(`${countryCode}0`);
          if (path) {
            path.classList.remove("selectable");
            path.classList.add("not-selectable");
          }
        });
      }
    }
  }, [selectedPeriod]);

  React.useEffect(() => {
    if (countrySelected) {
      // update the placeholder of the dropdown.
      const countryName = allCountriesInfo[countrySelected]?.title;
      updatePlaceHolderCountryDropdown(countryName);

      // if a country is selected, reset the selected programme
      setSelectedProgramme(null);
    } else {
      updatePlaceHolderCountryDropdown("Select a country");
    }
  }, [countrySelected]); // WATCH:countrySelected

  React.useEffect(() => {
    if (selectedProgramme) {
      setCountrySelected("");
      const programmeName = allProgrammes[selectedProgramme]?.post_title;
      updatePlaceHolderProgrammeDropdown(programmeName);
    } else {
      updatePlaceHolderProgrammeDropdown("Select a Programme");
    }
  }, [selectedProgramme, setCountrySelected]); //WATCH:selectedProgramme in the dropdown

  // window.addEventListener("resize", adjustMapResolution);
  React.useEffect(() => {
    if (
      !regionsToProgrammes ||
      !regionsToProgrammes.nuts3 ||
      !Object.keys(regionsToProgrammes.nuts3).length
    )
      return;

    Object.keys(regionsToProgrammes.nuts3).forEach((regCode) => {
      const path = refSVG.current.getElementById(regCode);

      // this makes the nuts3 change colout and react on hover.
      if (path) path.classList.add("selectable");

      const periodsInvolved = new Set();
      const programmesIds = regionsToProgrammes.nuts3[regCode];
      programmesIds.forEach((progID) => {
        periodsInvolved.add(allProgrammes[progID].period);
      });
      periodsInvolved.forEach((period) => {
        if (path) path.classList.add(`period-${period}`);
      });
    });
  }, [regionsToProgrammes, regionsToProgrammes.nuts3, allProgrammes]); // WATCH regionsToProgrammes.nuts3 (on load actually)

  // Disable transition on all .selectable elements inside #svg-map-container
  React.useEffect(() => {
    const container = document.getElementById("svg-map-container");
    if (container) {
      const selectables = container.querySelectorAll(".selectable");
      selectables.forEach((el) => {
        el.style.transition = "none";
      });
    }
  }, [regionsToProgrammes, allProgrammes]);

  // Calculate the periods. It will come out with ['eni-cbc', 'interreg-next'].
  React.useEffect(() => {
    if (!allProgrammes || !Object.keys(allProgrammes).length) return;
    const periods = new Set();
    Object.keys(allProgrammes).forEach((programmeID) => {
      const programme = allProgrammes[programmeID];
      if (!periods.has(programme.period)) {
        periods.add(programme.period);
      }
    });
    setPeriods(periods);
  }, [allProgrammes, setPeriods]);

  // **** WATCH hovered (a region is hovered!) *****

  React.useEffect(() => {
    if (!hovered) {
      setCountryHovered(null);
      return;
    }
    if (!regionsToProgrammes?.nuts3) return;
    // get the country from the region hovered
    const countryCode = hovered.substr(0, 2);
    // if country belongs to countries with programmes:
    if (
      regionsToProgrammes.countries &&
      regionsToProgrammes.countries[countryCode]
    ) {

      // We check that at least one of the programmes of the country is in the selected period.
      const programmesForCountry = regionsToProgrammes.countries[countryCode];
      const isInSelectedPeriod = programmesForCountry.some(
        (programmeID) =>
          allProgrammes[programmeID] &&
          allProgrammes[programmeID].period === selectedPeriod
      );


      if (isInSelectedPeriod) {
        setCountryHovered(countryCode);
      }
    }
  }, [hovered]); //WATCH. hovered is a region ID

  // watch country hovered: add class to highlight
  React.useEffect(() => {
    let domElCountry =
      refContainer.current.querySelectorAll(".country-hovered");
    if (domElCountry.length)
      domElCountry.forEach((el) => el.classList.remove("country-hovered"));
    if (countryHovered) {
      domElCountry = refContainer.current.querySelector(
        "#" + countryHovered + "0"
      ); // es0 is the code of country
      if (domElCountry) {
        domElCountry.classList.add("country-hovered");
      }
    }
  }, [countryHovered]); //WATCH

  // watch selection of country in dropdown.
  React.useEffect(() => {
    // shabby solution accesing to DOM eleemnts.

    var PHCountry = document.querySelector(
      '.search-by-country div[class*="placeholder"]'
    );
    if (!PHCountry)
      PHCountry = document.querySelector(
        '.search-by-country div[class*="singleValue"]'
      ); // if there was a value on it already.

    // there is some kind o f bug, I repeat this.
    let path = refContainer.current.querySelector(".country-selected");
    if (path) path.classList.remove("country-selected");
    if (
      countrySelected &&
      regionsToProgrammes &&
      regionsToProgrammes.countries[countrySelected]
    ) {
      // first, the mode of lookup comes back to 'map'.
      setAppOptions(
        Object.assign({ ...appOptions }, { showProjectsType: "all-programmes" })
      );

      let path = refContainer.current.querySelector(".country-selected");
      if (path) path.classList.remove("country-selected");
      path = refContainer.current.querySelector("#" + countrySelected + "0"); // path#es0
      if (path) path.classList.add("country-selected");

      removeHighlightForCountriesHighlightedBySelectedProgramme(refContainer);

      PHCountry.textContent = allCountriesInfo[countrySelected].title; // dropdown value needs to be changed by hand if selected from map
    }
    if (countrySelected === null) {
      // cleanup the country selected in map
      if (!refContainer.current) return;
      const path = refContainer.current.querySelector(
        "#" + countrySelected + "0"
      ); // path#es0
      if (path) path.classList.remove("country-selected");
      // cleanup the dropdown country

      PHCountry.textContent = "Select a country";
    }
  }, [
    countrySelected,
    allCountriesInfo,
    appOptions,
    regionsToProgrammes,
    setAppOptions,
  ]); //WATCH countrySelected (click on a country or selected from dropdown)

  // Programme hovered in left panel, when the 15 programmes are listed.
  React.useEffect(() => {
    if (!refContainer.current || !allProgrammes) return;
    // CLEANUP - if we have finished a hover. (this could be in the return)

    cleanupClassRegions(refContainer, "region-with-programme-hovered");
    cleanupClassRegions(
      refContainer,
      "country-beloging-to-with-programme-hovered"
    );

    if (!allProgrammes[hoveredProgramme]) {
      return;
    }
    // select the countries for that programme
    const countriesArray = allProgrammes[hoveredProgramme].countries
      .split(",")
      .filter((c) => c.length)
      .map((c) => c.trim() + "0");
    applyClassToRegions(
      refContainer,
      "country-beloging-to-with-programme-hovered",
      countriesArray
    );

    // Now apply class to regions, not to countries. Cleanup with cleanupHighlightedRegionsByProgrammeHovered
    if (hoveredProgramme && allProgrammes[hoveredProgramme]) {
      const regionsArray = allProgrammes[hoveredProgramme].nuts3.split(",");
      applyClassToRegions(
        refContainer,
        "region-with-programme-hovered",
        regionsArray
      );
    }
  }, [hoveredProgramme, allProgrammes]); //WATCH hoveredProgramme

  // Programme selected watch, when the 15 programmes are listed.
  // highlight the countries in the map
  React.useEffect(() => {
    if (!refContainer.current || !allProgrammes) return;
    // 1. CLEANUP - if we have finished a hover. (this could be in the return)
    cleanupClassRegions(refContainer, "programme-with-country-selected");
    cleanupClassRegions(refContainer, "country-selected");
    // cleanup classes for regions and start over
    cleanupClassRegions(refContainer, "region-with-programme-hovered");
    cleanupClassRegions(refContainer, "region-with-programme-selected");

    if (!allProgrammes[selectedProgramme]) {
      return;
    }

    // 2. highlight the countries for that programme
    const countriesArray =
      allProgrammes[selectedProgramme].countries.split(",");
    applyClassToRegions(
      refContainer,
      "programme-with-country-selected",
      countriesArray
    );

    // setCountrySelected(null);

    // Now the dropdown, update placeholder
    // shabby slution
    var PHProgramme = document.querySelector(
      '.search-by-programme div[class*="placeholder"]'
    );
    if (!PHProgramme)
      PHProgramme = document.querySelector(
        '.search-by-programme div[class*="singleValue"]'
      ); // if there was a value on it already.

    // when we come back grom the selected Programme
    if (!selectedProgramme) {
      removeHighlightForCountriesHighlightedBySelectedProgramme(refContainer);

      if (PHProgramme) PHProgramme.textContent = "Lookup by programme";
    } else {
      const programmeName = allProgrammes[selectedProgramme]?.post_title;
      if (PHProgramme) PHProgramme.textContent = programmeName;
    }

    if (selectedProgramme && allProgrammes[selectedProgramme]) {
      // 3. highlight the regions for that programme
      const regionsArray = allProgrammes[selectedProgramme].nuts3.split(",");
      applyClassToRegions(
        refContainer,
        "region-with-programme-selected",
        regionsArray
      );
    }
  }, [selectedProgramme, allProgrammes]); //WATCH selectedProgramme to highlight the country

  // when looking up by programme, if a country weas selected, we deselected it.
  React.useEffect(() => {
    if (appOptions.showProjectsType === "all-programmes") {
      setCountrySelected(null);
    } else if (appOptions.showProjectsType === "map") {
      setSelectedProgramme(null);
    }
  }, [appOptions.showProjectsType]); //WATCH (change from/to 'select country in map' - 'show programmes and select one')

  // COMPPUTED - flag to show or not the Programmes panel
  const showProgrammesPanel = React.useMemo(() => {
    return (
      appOptions.showProjectsType === "all-programmes" &&
      !countryHovered &&
      !countrySelected
    );
  }, [appOptions.showProjectsType, countryHovered, countrySelected]);

  const showCoutriesContent = React.useMemo(() => {
    return countryHovered || countrySelected;
  }, [countryHovered, countrySelected]);

  // **** HANDLERS *****
  const handleMouseMove = (e) => {
    // grab the hovered svg path and update the 'hovered' var with that code , ie es032
    var x = e.clientX,
      y = e.clientY,
      elementMouseIsOver = document.elementFromPoint(x, y);
    if (
      elementMouseIsOver &&
      elementMouseIsOver.classList?.contains(classSelectablePath)
    ) {
      setHovered(elementMouseIsOver.id);
    } else setHovered(null);
  };
  const handleClick = (e) => {
    // selecting country slows down everything in debug mode.
    if (isDebug) return;
    if (countryHovered) setCountrySelected(countryHovered);
  };
  // key escape listener: close the modal window with the project info
  useKeyPress(
    "Escape",
    () => {
      if (projectInModal) setProjectInModal(null);
    },
    [projectInModal]
  );

  // **** FUNCTIONS *****
  // TODELETE: not in use, it should be css driven.
  function adjustMapResolution() {
    const w = document.querySelector("body").offsetWidth;
    if (w > 700 && refSVG.current) {
      console.log("adjusting size map", w);
      refSVG.current.setAttribute(
        "height",
        (refSVG.current.clientWidth * 5) / 12 + "px"
      );
      refSVG.current.style.transform = `scale(1.01) translateX(${
        refSVG.current.clientWidth / 6
      }px)`;
    } else if (refSVG.current) {
      refSVG.current.removeAttribute("height");
      refSVG.current.removeAttribute("style");
    }
  }

  /** COMPUTED : considers all the main states that this app accepts and explains it with classes in an array */
  const currentStateClasses = React.useMemo(() => {
    let classes = [];
    if (hovered && allRegionsInfo[hovered]) classes.push("region-hovered");
    if (countryHovered) classes.push("country-hovered");
    if (countrySelected) classes.push("country-selected");
    if (showProgrammesPanel) classes.push("showing-programmes-selected");
    if (selectedProgramme) classes.push("programme-selected");
    if (projectInModal) classes.push("project-opened");
    if (selectedPeriod) classes.push("period-" + selectedPeriod);
    else classes.push("all-periods");
    return classes;
  }, [
    allRegionsInfo,
    hovered,
    showProgrammesPanel,
    countryHovered,
    countrySelected,
    projectInModal,
    selectedProgramme,
    selectedPeriod,
  ]);

  // *** T E M P L A T E ******    JSX    *******************************
  /**********************************************************************/
  return (
    <div
      className={`TM_container ${
        currentStateClasses.length
          ? "TM_container--active-state " + currentStateClasses.join(" ")
          : "TM_container--no-selection"
      } ${
        currentStateClasses.join(" ").substr("-selected")
          ? "TM_container--selection"
          : ""
      }`}
      ref={refContainer}
    >
      {Object.keys(allCountriesInfo).length > 0 && isDebug && (
        <Debug
          allCountriesInfo={allCountriesInfo}
          countrySelected={countrySelected}
        />
      )}

      <div id="TM_topbar" className="TM_row">
        <TopBar
          allProgrammes={allProgrammes}
          selectedProgramme={selectedProgramme}
          setSelectedProgramme={setSelectedProgramme}
          allProjects={allProjects}
          regionsToProgrammes={regionsToProgrammes}
          allRegionsInfo={allRegionsInfo}
          allCountriesInfo={allCountriesInfo}
          hovered={hovered}
          countryHovered={countryHovered}
          countrySelected={countrySelected}
          setCountrySelected={setCountrySelected}
          showProgrammesPanel={showProgrammesPanel}
          appOptions={appOptions}
          setAppOptions={setAppOptions}
          projectInModal={projectInModal}
          setProjectInModal={setProjectInModal}
          periods={periods}
          selectedPeriod={selectedPeriod}
        />
      </div>

      <div className="TM_row border TM_position-relative">
        {/* Character when nothing is selected */}
        <div className="TM_character-over-left-panel">
          <img
            src={
              getBaseUrl() + "char-map-" + Math.round(Math.random()) + ".png"
            }
            alt="char"
          />
        </div>

        {/* Panel on the left. Shows info of selected country or shows Search by programme */}
        <div className={"TM_left-panel"}>
          {!showCoutriesContent && !showProgrammesPanel && (
            <div className="TM_card">
              {"interreg-next" === selectedPeriod ? (
                <PanelIntroInterregNext />
              ) : "eni-cbc" === selectedPeriod ? (
                <PanelIntroENICBC />
              ) : (
                <PanelIntroDefault />
              )}
            </div>
          )}

          {showCoutriesContent && (
            <PanelCountryContent
              allCountriesInfo={allCountriesInfo}
              allProjects={allProjects}
              allProgrammes={allProgrammes}
              countriesToProjects={countriesToProjects}
              regionsToProgrammes={regionsToProgrammes}
              countryHovered={countryHovered}
              countrySelected={countrySelected}
              setCountrySelected={setCountrySelected}
              selectedProgramme={selectedProgramme}
              filterByTheme={filterByTheme}
              setFilterByTheme={setFilterByTheme}
              setProjectInModal={setProjectInModal}
              periods={periods}
              selectedPeriod={selectedPeriod}
            />
          )}

          {showProgrammesPanel && (
            <PanelProgrammesContent
              periods={periods}
              selectedPeriod={selectedPeriod}
              setSelectedPeriod={setSelectedPeriod}
              allProgrammes={allProgrammes}
              allProjects={allProjects}
              setProjectInModal={setProjectInModal}
              hoveredProgramme={hoveredProgramme}
              setHoveredProgramme={setHoveredProgramme}
              selectedProgramme={selectedProgramme}
              setSelectedProgramme={setSelectedProgramme}
              appOptions={appOptions}
              setAppOptions={setAppOptions}
              showProgrammesPanel={showProgrammesPanel}
              countryHovered={countryHovered}
            />
          )}
        </div>
      </div>

      {/* <!-- end left panel --> */}

      {/* The MAP */}
      <div className="TM_map-wrapper TM_col-12 tm_border TM_overflow-hidden">
        <div className="togglepill-wrapper">
          <TogglePill
            optionA="eni-cbc"
            optionB="interreg-next"
            optionALabel="ENI CBC"
            optionBLabel="Interreg Next"
            selected={selectedPeriod}
            onToggle={setSelectedPeriod}
          />
        </div>
        <svg
          ref={refSVG}
          width="100%"
          height="230px"
          className="n"
          id="svg-map-container"
          xmlns="http://www.w3.org/2000/svg"
          onMouseMove={handleMouseMove}
          onClick={handleClick}
        >
          <Europe />
        </svg>
      </div>

      {/* The footer with help information */}
      <footer></footer>

      {/* The MODAL WINDOW for the selected project PDF */}
      {projectInModal && (
        <div
          className="tm_tesim-modal__wrapper"
          tabIndex="-1"
          role="dialog"
          aria-hidden="true"
          onClick={(e) => setProjectInModal(null)}
        >
          <div className="tm_tesim-modal__inner">
            <BackPanelButton
              onClickHandle={() => setProjectInModal(null)}
              color="info"
            />

            <iframe
              src={
                projectInModal.permalink ??
                allProjects.find((p) => p.ID === projectInModal).permalink
              }
            ></iframe>
          </div>
        </div>
      )}
    </div>
  );
}
