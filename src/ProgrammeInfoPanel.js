import React from 'react'
import ProjectInfo from './ProjectInfo'

export default function ProgrammeInfoPanel({ programmeInfo, projectsInfo,
                                             projectInModal, setProjectInModal }) {


    return (
        <div className="programme-and-projects row">
            <div className='programme-name col-3'>
                <img src={programmeInfo.logo} className="img-fluid img-thumbnail" />
                <h3 className='h5'>{programmeInfo.post_title}</h3>
                <p>{projectsInfo.length} projects</p>
            </div>
            <ul className="projects-list p-0 row col-9 list-unstyled">
                { projectsInfo.map( projectInfo => 
                    <li key={`proj-${projectInfo.ID}`} className='col-3'
                        onClick={e=> {
                            setProjectInModal(projectInfo   )
                            
                            }}>
                        <ProjectInfo projectInfo={projectInfo} />
                    </li>    
                )}
            </ul>
        </div>
    )
}
