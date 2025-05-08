import React from "react";
import Europe from "./SVGEurope";

import useKeyPress from "./helpers/useKeyPress";
import { getBaseUrl, removeHighlightForCountriesHighlightedBySelectedProgramme } from "./helpers/utils";

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

export default function Map({
  allProgrammes,
  allProjects,
  allRegionsInfo,
  allCountriesInfo,
  regionsToProgrammes,
  countriesToProjects,
  appOptions,
  setAppOptions,
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
    setFilterByTheme(null);
    // adjustMapResolution();
  }, [selectedPeriod]);

  React.useEffect(() => {
    setSelectedProgramme(null);
  }, [countrySelected]);



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
  }, [regionsToProgrammes, regionsToProgrammes.nuts3]);

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
    )
      setCountryHovered(countryCode);
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


    // shabby slution
    var PHProgramme = document.querySelector(
      '.search-by-programme div[class*="placeholder"]'
    );
    if (!PHProgramme)
      PHProgramme = document.querySelector(
        '.search-by-programme div[class*="singleValue"]'
      ); // if there was a value on it already.

    // when we come back grom the selected Programme
    if ( ! selectedProgramme ) {
      removeHighlightForCountriesHighlightedBySelectedProgramme(refContainer);
      PHProgramme.textContent = 'Lookup by programme';
    } else {
      const programmeName = allProgrammes[selectedProgramme]?.post_title;
      PHProgramme.textContent = programmeName;
    }


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
  }, [countrySelected, selectedProgramme]); //WATCH (click on a country or selected from dropdown)

  // Programme hovered, when the 15 programmes are listed.
  React.useEffect(() => {
    if (!refContainer.current || !allProgrammes) return;
    // CLEANUP - if we have finished a hover. (this could be in the return)
    const c = refContainer.current.querySelectorAll(
      ".programme-with-country-hovered"
    );
    c.forEach((cc) => cc.classList.remove("programme-with-country-hovered"));
    if (!allProgrammes[hoveredProgramme]) {
      return;
    }
    // select the countries for that programme
    const countriesArray = allProgrammes[hoveredProgramme].countries.split(",");
    countriesArray.forEach((code) => {
      if (code.trim().length) {
        // and apply the class
        const path = refContainer.current.querySelector("#" + code + "0"); // path#es0
        if (path) path.classList.add("programme-with-country-hovered");
      }
    });
  }, [hoveredProgramme]); //WATCH

  // Programme selected watch, when the 15 programmes are listed.
  React.useEffect(() => {
    if (!refContainer.current || !allProgrammes) return;
    // CLEANUP - if we have finished a hover. (this could be in the return)
    const c = refContainer.current.querySelectorAll(
      ".programme-with-country-selected"
    );
    c.forEach((cc) => cc.classList.remove("programme-with-country-selected"));
    const d = refContainer.current.querySelectorAll(".country-selected");
    d.forEach((cc) => cc.classList.remove("country-selected"));
    if (!allProgrammes[selectedProgramme]) {
      return;
    }
    // select the countries for that programme
    const countriesArray =
      allProgrammes[selectedProgramme].countries.split(",");
    countriesArray.forEach((code) => {
      if (code.trim().length) {
        // and apply the class
        const path = refContainer.current.querySelector("#" + code + "0"); // path#es0
        if (path) path.classList.add("programme-with-country-selected");
      }
    });

    // setCountrySelected(null);



  }, [selectedProgramme]); //WATCH

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
    return appOptions.showProjectsType === "all-programmes" && !countryHovered && !countrySelected;
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
      <div id="TM_topbar" className="TM_row">
        <TopBar
          allProgrammes={allProgrammes}
          selectedProgramme={selectedProgramme} setSelectedProgramme={setSelectedProgramme}
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
            <BackPanelButton onClickHandle={() => setProjectInModal(null)} color="info" />

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
