/** Replacement of .env with this function
 * It simplifies the understanding.
 */

export function getBaseUrl() {
  return window.location.href.includes("localhost")
    ?
    // "http://tesimnew.local/wp-content/themes/understrap-child-master/inc/react-map/" // doesnt work because of Cors
    // if we dont have the local env open, use:
    './'
    : "./wp-content/themes/understrap-child-master/inc/react-map/";
}

export function themeToLabel(theme) {
  switch (theme) {
    case "environment":
    case "environment-2025":
      return "Environment";
    case "p2p":
      return "People to People";
    case "social-inclusion-2025":
      return "Social Inclusion";
    case "economic":
      return "Economic Development";
    case "smart-growth-2025":
      return "Smart growth";
    case "infrastructure":
      return "Infrastructure";
    case "border-2025":
      return "Border management";
    case "governance-2025":
      return "Governance";
    default:
      break;
  }
}

/**
 * Given 'Interreg Next', converts it into 'Interreg NEXT', and more like that.
 * @param {*} period
 * @returns
 */
export function sanitizePeriodName(period) {
  let newPeriod = period.replace(/-/g, ' ');
  newPeriod = newPeriod.charAt(0).toUpperCase() + newPeriod.slice(1);
  newPeriod = newPeriod.replace('Next', 'NEXT').replace('next', 'NEXT');
  newPeriod = newPeriod.replace('Eni cbc', 'ENI CBC');
  return newPeriod;
}

export function cleanupClassRegions( mapRef, className ) {
  if (!mapRef || !mapRef.current) return;
  if (!className) return;
  const c = mapRef.current.querySelectorAll("." + className);
  c.forEach((cc) => cc.classList.remove(className));
}

export function applyClassToRegions( mapRef, className, regionsArray ) {
  regionsArray.forEach((code) => {
      if (code.trim().length) {
        // and apply the class
        const path = mapRef.current.querySelector("#" + code); // path#es0
        if (path) path.classList.add(className);
      }
  });
}


// TODELETE: we shouldnt need this anymore, after
// updating economical into economic.
// export function themeToProjectColor(theme) {
//   switch (theme) {
//     case "environment":
//       return "environment";
//     case "p2p":
//       return "p2p";
//     case "economic":
//       return "economical";
//     case "infrastructure":
//       return "infrastructures";


//     case "governance":
//       return "governance";
//     default:
//       return theme;
//   }
// }

export function removeHighlightForCountriesHighlightedBySelectedProgramme(mapRef) {
  cleanupClassRegions(mapRef, "programme-with-country-selected");
  cleanupClassRegions(mapRef, "programme-with-country-hovered");
}

// shabby way to iupdate placeholder.
export function updatePlaceHolderCountryDropdown(testInPH) {
  let PHCountry = document.querySelector('.search-by-country div[class*="placeholder"]');
  if (!PHCountry) {
    PHCountry = document.querySelector('.search-by-country div[class*="singleValue"]');
  }
  if (PHCountry) {
    PHCountry.innerHTML = testInPH;
  }
}
export function updatePlaceHolderProgrammeDropdown(testInPH) {
  let PHProgrammeDropdown = document.querySelector('.search-by-programme div[class*="placeholder"]');
  if (!PHProgrammeDropdown) {
    PHProgrammeDropdown = document.querySelector('.search-by-programme div[class*="singleValue"]');
  }
  if (PHProgrammeDropdown) {
    PHProgrammeDropdown.innerHTML = testInPH;
  }
}