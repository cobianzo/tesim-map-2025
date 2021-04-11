import React from 'react'
import Map from './Map';

import './App.scss';


function App() {

  // **** STATES *****
  const [allProgrammes, setAllProgrammes] = React.useState({}); // set in API call fetchProgrammesProjects, once. // Object of programmes with Key=programme ID. { "5224": { "ID": 5224, "post_title": "Hungary - Slovakia - Romania - Ukraine ENI CBC", "post_name": "hungary-slovakia-romania-ukraine-eni-cbc", "nuts3": "hu323,hu311,ro215,ro114,ro115,sk042,sk041,uab08,ua006,ua003", "countries": "hu,ro,sk,ua" },  "5233": { ...

  const [allProjects, setAllProjects] = React.useState([]); // in fetchProgrammesProjects, once.
  const [regionsToProgrammes, setRegionsToProgrammes] = React.useState({}); // calculated
  const [allRegionsInfo, setAllRegionsInfo] = React.useState({}); // set on API call, once

  // **** ON MOUNT *****
  React.useEffect( () => {
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
    const endpoint = 'projects-and-programmes.json';
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
      let regionsToProg = {};
      Object.keys(res.programmes).forEach((ID) => {
        const progInfo = res.programmes[ID];
        const regions = progInfo.nuts3.split(','); // str (list of nuts3 codes) separated by commas
        regions.forEach( nuts3Code => {
          regionsToProg[nuts3Code] = regionsToProg[nuts3Code] || [];
          regionsToProg[nuts3Code].push(ID);
        })
      })
      setRegionsToProgrammes(regionsToProg);

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
    } )
    .catch(err => {
        console.warn('res error: ', res);
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
    const endpoint  = 'regions.json';
    const res       = await fetch(endpoint);
    // console.log('Antes de json es : ', res);
    res.json().then(res => { 
      console.log('all regions desde json dio: ', res);
      setAllRegionsInfo(res);
    }).catch(err => {
      console.warn('ERRRORRerror capturing regions info: ', err);
    });;
  }

  return (
    <div className="App">
      <Map allProgrammes={allProgrammes}
           allProjects={allProjects}
           regionsToProgrammes={regionsToProgrammes}
           allRegionsInfo={allRegionsInfo} />
    </div>
  );
}

export default App;
