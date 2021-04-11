import React from 'react'

export default function ProjectInfo({ ID, allProjects }) {
    return (
        <div className="project-details">
            {ID} <br/>
            { allProjects[ID] && allProjects[ID].post_title }
        </div>
    )
}


