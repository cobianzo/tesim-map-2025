import React from 'react'
import ProjectInfo from './ProjectInfo'

/**
 * 
 * @param {int} programmeId : given the programme post ID, we display info and projects.
 * @returns 
 */
export default function ProgrammePanel({
    programmeId,
    allProgrammes,
    allProjects
}) {

    // const [programmeInfo, setProgrammeInfo] = React.useState({});
    // React.useEffect(() => {
    //     setProgrammeInfo(allProgrammes[programmeId]);
    //     return () => {
    //     }
    // }, [programmeId]);

    if (!allProgrammes[programmeId]||!Object.keys(allProgrammes[programmeId]).length) return 'no prog'+programmeId;
    return (
        <div className="programme-title" key={`prg-${allProgrammes[programmeId].ID}`}> 
            <p className="h4">{ allProgrammes[programmeId].post_title }</p>
            <span className="badge badge-secondary d-block">
                { allProgrammes[programmeId].projects?.length } projects
            </span>

            { allProgrammes[programmeId].projects.map( ID => (
                <ProjectInfo ID={ID} allProjects={allProjects} key={`pi-${ID}`}/>
            )) }
        </div>
    )
}

