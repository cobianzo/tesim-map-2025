import React from 'react'
import Map from './Map';
import SearchByRegion from './SearchByRegion';
import './App.scss';


function App() {

  // **** STATES *****
  const [allProgrammes, setAllProgrammes] = React.useState({}); // set in API call fetchProgrammesProjects, once. // Object of programmes with Key=programme ID. { "5224": { "ID": 5224, "post_title": "Hungary - Slovakia - Romania - Ukraine ENI CBC", "post_name": "hungary-slovakia-romania-ukraine-eni-cbc", "nuts3": "hu323,hu311,ro215,ro114,ro115,sk042,sk041,uab08,ua006,ua003", "countries": "hu,ro,sk,ua" },  "5233": { ...
  const [allProjects, setAllProjects] = React.useState([]); // in fetchProgrammesProjects, once. // array of obj project:   [  {"ID": 7537,"permalink": "http:\/\/localhost:9000\/snippet\/cgtn\/","pdf_link": "https:\/\/tesim-enicbc.eu\/wp-content\/uploads\/2021\/02\/CGTN.pdf","external_featured_image": "https:\/\/tesim-enicbc.eu\/wp-content\/uploads\/2021\/01\/CGTN.png","links_and_map": "https:\/\/keep.eu\/projects\/23032\/Cross-border-green-transpor-EN\/ \r\nTESIM story https:\/\/tesim-enicbc.eu\/voices\/ihor-popodyuk\/ \r\nProject page https:\/\/huskroua-cbc.eu\/projects\/financed-projects-database\/cross-border-green-transport-network \r\nFacebook https:\/\/www.facebook.com\/CGTN.HUSKROUA\/","color": "infrastructures",    "programme": 5224 },
  const [regionsToProgrammes, setRegionsToProgrammes] = React.useState({}); // calculated // { tr325: [5435], tr34: ... }
  const [allRegionsInfo, setAllRegionsInfo] = React.useState({}); // set on API call, once { tr325: {title: "Capadocchia", description }, ... }
  const [allCountriesInfo, setAllCountriesInfo] = React.useState({}); // set on API call, once
  const [appOptions, setAppOptions] = React.useState({ showProjectsType: 'programmes' });
  
  // **** ON MOUNT *****
  React.useEffect( () => {
    setAppOptions({ showProjectsType: 'programmes' });
    fetchProgrammesProjects();
    fetchAllRegionsNames();
  }, []);

  // **** WATCH allProgrammes *****
  React.useEffect( () => {
    if (!allProgrammes) return;
  }, [allProgrammes]);

  // **** FUNCTIONS *****
  async function fetchProgrammesProjects() {
    // get programmes with fetch > update state > 
    //            when finish get all projects and fetch into from api > update state projects.
    //            and prepare array for regions > update state
    const endpoint  = `${process.env.REACT_APP_LOCAL_ENDPOINT}projects-and-programmes.json`; // created by interreg project with php fn:  get_all_eni_projects()
    console.log('openENDPOINT ProPro: ',endpoint)
    const res = await fetch(endpoint);
    res.json().then(res => { 
      console.log('all Programmes and projects dio: ', res);
      setAllProjects(res.projects);

      // before saving the programmes, we add the field of projects, so we have both ways info
      res.projects.forEach( projectObj => {
        // set the programme's projects
        if (projectObj.programme) { // return ID programme, str "5224"          
          const programmeInfo  = res.programmes[projectObj.programme];
          programmeInfo.projects = programmeInfo.projects || [];
          res.programmes[projectObj.programme].projects.push(parseInt(projectObj.ID));
        }
        
      })
      setAllProgrammes(res.programmes);

      // set the regions programmes and projects update
      let nuts3ToProg = {};
      let countryToProg = {};
      Object.keys(res.programmes).forEach((ID) => {
        const progInfo = res.programmes[ID];
        const regions = progInfo.nuts3.split(','); // str (list of nuts3 codes) separated by commas
        regions.forEach( nuts3Code => {
          const countryCode = nuts3Code.substr(0,2);
          
          nuts3ToProg[nuts3Code] = nuts3ToProg[nuts3Code] || [];
          nuts3ToProg[nuts3Code].push(ID);
          countryToProg[countryCode] = countryToProg[countryCode] || [];
          
          if (!countryToProg[countryCode].includes(ID)) {
            countryToProg[countryCode].push(ID);
          }
        });
      })

      setRegionsToProgrammes({ nuts3: nuts3ToProg, countries: countryToProg});

      // fetchAllRegionsNames();
      
      
      // let allProjectsTogether = [];
      // let allRegionsToProgrammes = {};
      // res.forEach( prog => {
      //   // project preparation of ids
      //   if (prog.projects?.length)
      //     allProjectsTogether = [...new Set([...allProjectsTogether,...prog.projects])]; // O(n)
      //   // regions set up of array. { bg323: [black-sea], ... ]}
        
      //   // capture the regions for every programme
      //   const regionsIds = prog.regions.split(',');
      //   if (regionsIds.length) {
      //     regionsIds.forEach(regId => {
      //       if (!allRegionsToProgrammes[regId]) 
      //         allRegionsToProgrammes[regId] = [];
      //       if (!allRegionsToProgrammes[regId].includes(prog.ID)) 
      //         allRegionsToProgrammes[regId].push(prog.ID);
      //     });
      //   }
      // });
      
      // fetchProjectByIds(allProjectsTogether);
      // if (allRegionsToProgrammes)
      //   setRegionsToProgrammes(allRegionsToProgrammes); // called only once
    } ).catch(err => {
        console.error('res error: ', err);
      });
  }

  /**
   * 
   * @param { array of int | int | string } ids.
   */
  async function fetchProjectByIds( ids ) {
    
    let idsArray = ids;
    if ( typeof ids !== 'object') {
      idsArray = [ parseInt(ids) ];
    }
    var newProjectsObject = {};
    idsArray.forEach( async (id) => {
      
      if ( allProjects[id] ) return; // if this id already existed
      
      const endpoint  = `${process.env.REACT_APP_ENDPOINT_WP}/bl/v1/snippet/${id}`;
      
      const response  = await fetch(endpoint);
      
      response.json().then(project => {

        console.log('fetch project ' + endpoint + ' ID dio: ', project); // [ { ID:2, post_title:...}, {}, ...]
        // setAllPages(res);
        if (project && !newProjectsObject[id]) {
          newProjectsObject[id] = project;
        }
        // this check ensures that we save only when all projects are loaded (we are in an async)
        if (Object.keys(newProjectsObject).length === ids.length) {
          let newAllP = Object.assign(allProjects, newProjectsObject);
          setAllProjects(newAllP);
        }
        
      } );
    });
  }

  async function fetchAllRegionsNames() {
    const endpoint  = `${process.env.REACT_APP_LOCAL_ENDPOINT}regions.json`;
    console.log('openENDPOINT regions: ',endpoint)
    const res       = await fetch(endpoint);
    // API call to grab the name of every region code  { "es008" : { title: regionname }),  ...}
    res.json().then(res => { 
      console.log('all regions desde json dio: ', res);
      setAllRegionsInfo(res);
    }).catch(err => {
      console.error('ERRRORRerror capturing regions info: ', err.message);
    });
    // fetch countries: TODO: we could use this to colour all regions using the category of every country.
    const endpointC  = `${process.env.REACT_APP_LOCAL_ENDPOINT}countries.json`;
    console.log('openENDPOINT countries: ',endpointC)
    (await fetch(endpointC)).json().then(res => setAllCountriesInfo(res) )
              .catch(err => console.error('mal countries', err) );
  }

  // *** T E M P L A T E ******    JXS    *******************************
  /**********************************************************************/ 
  return (
    <div className="TM_App">
      <button className={`TM_btn TM_btn-primary ${appOptions.showProjectsType}`}
              onClick={ e => {
                const newAppOptions = {...appOptions};
                newAppOptions.showProjectsType = appOptions.showProjectsType === 'all-projects-together'? 'projects-by-programme' : 'all-projects-together';
                setAppOptions(newAppOptions);
                }}>
        {appOptions.showProjectsType === 'all-projects-together' ? 
          <span>All projects</span>: <span>Projects by Programme</span>}
      </button>
      <Map allProgrammes={allProgrammes}
           allProjects={allProjects}
           regionsToProgrammes={regionsToProgrammes}
           allRegionsInfo={allRegionsInfo} allCountriesInfo={allCountriesInfo}
           appOptions={appOptions} />
    </div>
  );
}

export default App;
