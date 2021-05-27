import React from 'react'
import ProjectInfo from './ProjectInfo'

export default function ProgrammeInfoPanel({ programmeInfo, projectsInfo,
                                             projectInModal, setProjectInModal }) {


    return (
        <div className="programme-and-projects tm_row">
            <div className='programme-name'>
                <img src={programmeInfo.logo} className="tm_img-fluid img-thumbnail" />
                <h3 className='h5'>{programmeInfo.post_title}</h3>
                <p>{projectsInfo.length} projects</p>
            </div>
            <ul className="projects-list p-0 tm_row tm_list-unstyled">
                { projectsInfo.map( projectInfo => 
                    <li key={`proj-${projectInfo.ID}`} className='n'
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
