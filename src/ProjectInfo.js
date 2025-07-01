import React from "react";

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
export default function ProjectInfo({
  setProjectInModal,
  projectInfo,
  filterByTheme,
}) {
  function get_thumbail_from_pdf_filename() {
    if (!projectInfo) return ""; // TODO: use placeholder
    if (projectInfo.external_cover_image)
      return projectInfo.external_cover_image;
    const pdfFilename = projectInfo.pdf_link;
    const baseFilename = pdfFilename
      ? pdfFilename.substr(0, pdfFilename.indexOf(".pdf"))
      : "https://tesim-enicbc.eu/wp-content/uploads/2021/09/placeholder";
    // const imgFilename = baseFilename + '-pdf-297x420.jpg';
    const imgFilename = baseFilename + "-pdf-724x1024.jpg"; // need to create https://tesim-enicbc.eu/wp-content/uploads/2021/09/placeholder-pdf-724x1024.jpg
    return imgFilename;
  }

  var classes_long_title = React.useMemo(() => {
    if (!projectInfo) return false;
    const fullTitle =
      projectInfo.post_title + " | " + projectInfo?.post_subtitle;
    let classes = "";
    if (fullTitle.length > 50) classes += " long-title-1";
    if (fullTitle.length > 70) classes += " long-title-2";
    if (fullTitle.length > 90) classes += " long-title-3";
    if (fullTitle.length > 110) classes += " long-title-4";
    if (fullTitle.length > 130) classes += " long-title-5";
    return classes;
  }, [projectInfo]);

  return (
    <li
      onClick={(e) => {
        // window.open(projectInfo?.permalink, '_blank');
        setProjectInModal(projectInfo.ID);
      }}
      className={`project-${projectInfo?.color}`}
    >
      <div className="tm_img-wrapper">
        <img
          src={projectInfo.image_poster ?? get_thumbail_from_pdf_filename()}
          className="tm_img-fluid"
          alt="poster"
        />
      </div>
      <div className={`small project-title ${classes_long_title}`}>
        {projectInfo?.post_title && (
          <p className="main-title">
            <b>{projectInfo?.post_title}</b>
          </p>
        )}
        {projectInfo?.post_subtitle && (
          <p className="sub-title">{projectInfo?.post_subtitle}</p>
        )}
      </div>
    </li>
  );
}
