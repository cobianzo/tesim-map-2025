/** Replacement of .env with this function
 * It simplifies the understanding.
 */

export function getBaseUrl() {
  return window.location.href.includes(".local") || window.location.href.includes("interregtesimnext")
    ? "./wp-content/themes/understrap-child-master/inc/react-map/"
    : "./";
}

export function themeToLabel(theme) {
  switch (theme) {
    case "environment":
      return "Environment";
    case "p2p":
      return "People to People";
    case "economic":
      return "Economic Development";
    case "infrastructure":
      return "Infrastructure";
    case "governance":
      return "Governance";
    default:
      break;
  }
}

export function themeToProjectColor(theme) {
  switch (theme) {
    case "environment":
      return "environment";
    case "p2p":
      return "p2p";
    case "economic":
      return "economical";
    case "infrastructure":
      return "infrastructures";
    case "governance":
      return "governance";
    default:
      break;
  }
}
