// custom hook
import { useEffect, useState } from "react";

/** Given `country`, and for the `selectedPeriod`,
 * returns the programmes in that period and that country
 * @return
 *
 */
function useFilteredProgrammesForCountry({
  country,
  allProgrammes,
  selectedPeriod,
}) {
  const [filteredProgrammes, setFilteredProgrammes] = useState([]);

  // Programmes
  useEffect(() => {
    if (!country) {
      setFilteredProgrammes([]);
      return;
    }

    // get all programmes for the selected country.
    const programmeIDs = Object.keys(allProgrammes).filter(progID => {
      const countries = allProgrammes[progID].countries.split(',');
      return countries.includes(country);
    })

    // const programmeIDs = regionsToProgrammes.countries[country];
    if (!programmeIDs) {
      setFilteredProgrammes([]);
      return;
    }

    // Filter by eni-cbc or interreg-next programmes, depending on current user selection
    const filtered = programmeIDs
      .map((id) => allProgrammes[id])
      .filter(
        (programme) =>
          programme &&
          (!selectedPeriod || programme.period === selectedPeriod)
      );

    setFilteredProgrammes(filtered);
  }, [country, allProgrammes, selectedPeriod]);

  return filteredProgrammes;
}

export default useFilteredProgrammesForCountry;