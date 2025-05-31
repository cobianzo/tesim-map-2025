import React from "react";
import { sanitizePeriodName } from "../helpers/utils";

function InfoProgrammesAndProjectsForCountry({
  theCountry,
  programmesForSelectedCountry,
  projectsForSelectedCountry,
  selectedPeriod,
}) {
  return (
    <>
      {theCountry ?  <h2 className="TM_h2 tm_mt-0"><b>{theCountry}</b></h2>  : null }
      {programmesForSelectedCountry?.length > 0 && (
        <p>
          {`Participating in ${programmesForSelectedCountry.length} `}
          {`Programme${programmesForSelectedCountry.length > 1 ? "s" : ""}`}
          {selectedPeriod
            ? ` for the period ${ sanitizePeriodName(selectedPeriod) }`
            : ``}
          :
          {programmesForSelectedCountry.length > 0 &&
            programmesForSelectedCountry.map((programme, i) => (
              <b key={`pro-${i}`}>
                {i > 0 && "; "} {programme.post_title}
              </b>
            ))}
          <br />
          {projectsForSelectedCountry?.length > 0 ? (
            <span>
              <b>{projectsForSelectedCountry.length}</b>
              {projectsForSelectedCountry.length > 1 ? (
                <span>
                  {" "}
                  <b>projects</b> are
                </span>
              ) : (
                <>
                  {" "}
                  <b>project</b> is
                </>
              )}
              &nbsp; shown in this exhibition{" "}
              {selectedPeriod
                ? ` for the period ${sanitizePeriodName(selectedPeriod)}`
                : ``}
            </span>
          ) : (
            projectsForSelectedCountry.length > 0 && (
              <span>
                <br />
                Engaged in {projectsForSelectedCountry.length}{" "}
                {selectedPeriod.replace(/-/g, " ").toUpperCase()} projects
                outside this exhibition
              </span>
            )
          )}
        </p>
      )}
    </>
  );
}

export default InfoProgrammesAndProjectsForCountry;
