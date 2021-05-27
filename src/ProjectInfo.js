import React from 'react'

/*
            "ID": 7537,
            "post_title": "CGTN",
            "permalink": "http:\/\/localhost:9000\/snippet\/cgtn\/",
            "pdf_link": "https:\/\/tesim-enicbc.eu\/wp-content\/uploads\/2021\/02\/CGTN.pdf",
            "external_featured_image": "https:\/\/tesim-enicbc.eu\/wp-content\/uploads\/2021\/01\/CGTN.png",
            "links_and_map": "https:\/\/keep.eu\/projects\/23032\/Cross-border-green-transpor-EN\/ \r\nTESIM story https:\/\/tesim-enicbc.eu\/voices\/ihor-popodyuk\/ \r\nProject page https:\/\/huskroua-cbc.eu\/projects\/financed-projects-database\/cross-border-green-transport-network \r\nFacebook https:\/\/www.facebook.com\/CGTN.HUSKROUA\/",
            "color": "infrastructures",
            "programme": 5224
*/
export default function ProjectInfo({ projectInfo }) {
  
    
    function get_thumbail_from_pdf_filename() {
        const pdfFilename = projectInfo.pdf_link;
        const baseFilename = pdfFilename.substr(0, pdfFilename.indexOf('.pdf') );
        // const imgFilename = baseFilename + '-pdf-297x420.jpg';
        const imgFilename = baseFilename + '-pdf-724x1024.jpg';
        return imgFilename;
    }

    return (
        <>
            <img src={get_thumbail_from_pdf_filename()} className="tm_img-fluid" />
            <div className='small'>
                { projectInfo.post_title }
            </div>
        </>
    )
}


