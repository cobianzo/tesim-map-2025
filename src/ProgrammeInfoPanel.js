import React from 'react'
import ProjectInfo from './ProjectInfo'

export default function ProgrammeInfoPanel({programmeInfo, projectsInfo}) {
    return (
        <div>
            <h3 className='h5'>{programmeInfo.post_title}</h3>
            <p>{projectsInfo.length} projects</p>
            <ul className="projects-list p-0 row">
                { projectsInfo.map( projectInfo => 
                    <li key={`proj-${projectInfo.ID}`} className='list-unstyled col-3'>
                        <ProjectInfo projectInfo={projectInfo} />
                    </li>    
                )}
            </ul>
        </div>
    )
}
