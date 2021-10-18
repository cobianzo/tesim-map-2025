<?php

/**  *
 * @package understrap
 */
?>
<html>
<head>
	<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/snippet.css?v=2'; ?>" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" crossorigin="anonymous" />
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
	<title><?php wp_title(); ?></title>
	<style>
		
.container {
  max-width: none; }

.container-content {
  max-width: 100%;
  width: 760px;
  margin: auto;
  font-family: 'Didact Gothic', sans-serif;
  overflow: scroll;
  height: 100%; }
  .container-content iframe {
    width: 100%;
    height: auto;
    min-height: 350px; }
  .container-content .content-text {
    max-width: 600px; }

p {
  width: 100%; }

iframe {
  height: calc(100vh - 50px); }

.tab {
  position: absolute;
  margin-top: -28px;
  background: white;
  padding: 5px 10px;
  border-radius: 0 5px 0 0;
  font-family: sans-serif;
  font-weight: bold;
  box-shadow: 5px -4px 6px rgba(0, 0, 0, 0.2); }

.links-container {
  display: flex;
  width: 100%;
  grid-template-columns: 1fr 1fr 1fr 1fr; 
}
  .links-container a {
    display: flex;
    flex-grow: 1;
    height: 30px;
    align-items: center;
    justify-content: center;
    padding: 2px 10px;
    border: 1px solid lightgray;
    border-radius: 5px;
    font-family: sans-serif;
    font-size: 10pt;
    min-width: 100px;
    color: #742670;
    text-decoration: none;
    margin-right: 2px; }
    .links-container a:hover {
      color: #331131;
      border-color: #331131; }

html, body {
  overflow: hidden; 
border: 0; padding: 0; margin: 0;
}

.keep-link {
  flex-direction: column;
  width: 250px;
  max-width: 25%;
  height: 30px !important;
  margin-top: calc( 30px * -1 + 30px);
  z-index: 9;
  background: white; }
  @media (min-width: 576px) {
    .keep-link {
      height: 90px !important;
      margin-top: calc( 90px * -1 + 30px);
      transition: all 1s; }
      .keep-link:hover {
        height: 260px !important;
        margin-top: calc( 260px * -1 + 30px); } }
  .keep-link:hover {
    background: #dfd8d8; }
  .keep-link .map-thumbnail {
    display: none !important;
    width: calc( 100% + 12px);
    display: block;
    margin-left: 0px;
    height: calc(100% - 30px); }
    @media (min-width: 576px) {
      .keep-link .map-thumbnail {
        display: block !important; } }
    .keep-link .map-thumbnail img {
      -o-object-fit: cover;
         object-fit: cover;
      border: 1px solid gray;
      width: calc(100% - 8px);
      margin-left: 3px;
      height: 100%; }
  .keep-link .button-bottom {
    height: 30px;
    width: 100%;
    margin-top: 0px;
    text-align: center; }
    .keep-link .button-bottom img {
      margin-top: 7px;
      height: 100%;
      max-width: 100%; }

body.environment {
  --link-color: #5aa05d; }

body.p2p {
  --link-color: #962c6a; }

body.infrastructures {
  --link-color: #c9483e; }

body.economical {
  --link-color: #2e617f; }

.link-bottom.link-text {
  color: var(--link-color);
  border-color: var(--link-color); }
  .link-bottom.link-text:hover {
    background-color: var(--link-color);
    color: white; }

/*# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNuaXBwZXQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFTQSxrRkFBWTtBQUVaO0VBQ0ksZUFBZSxFQUFBOztBQUVuQjtFQUNJLGVBQWU7RUFDZixZQUFZO0VBQ1osWUFBWTtFQUNaLHdDQUF3QztFQUN4QyxnQkFBZ0I7RUFDaEIsWUFBWSxFQUFBO0VBTmhCO0lBU1EsV0FBVztJQUNYLFlBQVk7SUFDWixpQkFBaUIsRUFBQTtFQVh6QjtJQWNRLGdCQUFnQixFQUFBOztBQUd4QjtFQUFJLFdBQVksRUFBQTs7QUFDaEI7RUFDSSwwQkFBMEIsRUFBQTs7QUFHOUI7RUFDSSxrQkFBa0I7RUFDbEIsaUJBQWlCO0VBQ2pCLGlCQUFpQjtFQUNqQixpQkFBaUI7RUFDakIsd0JBQXdCO0VBQ3hCLHVCQUF1QjtFQUN2QixpQkFBaUI7RUFDakIsMkNBQXdDLEVBQUE7O0FBRTVDO0VBQ0ksYUFBYTtFQUNiLHNDQUFzQyxFQUFBO0VBRjFDO0lBSVEsYUFBYTtJQUNiLFlBQVk7SUFDWixZQUFZO0lBQ1osbUJBQW1CO0lBQ25CLHVCQUF1QjtJQUN2QixpQkFBaUI7SUFDakIsMkJBQTJCO0lBQzNCLGtCQUFrQjtJQUNsQix1QkFBdUI7SUFDdkIsZUFBZTtJQUNmLGdCQUFnQjtJQUNoQixjQUFjO0lBQ2QscUJBQXFCO0lBQ3JCLGlCQUFpQixFQUFBO0lBakJ6QjtNQW1CWSxjQUFjO01BQ2QscUJBQXFCLEVBQUE7O0FBSWpDO0VBQ0ksZ0JBQWdCLEVBQUE7O0FBU3BCO0VBQ0ksc0JBQXNCO0VBQ3RCLFlBQVk7RUFDWixjQUFjO0VBQ2QsdUJBQWtDO0VBQ2xDLG1DQUFpRDtFQUNqRCxVQUFVO0VBQ1YsaUJBQWlCLEVBQUE7RUFFakI7SUFUSjtNQVVRLHVCQUErQjtNQUMvQixtQ0FBOEM7TUFDOUMsa0JBQWtCLEVBQUE7TUFaMUI7UUFnQlksd0JBQW9DO1FBQ3BDLG9DQUFtRCxFQUFBLEVBQ3REO0VBbEJUO0lBc0JRLG1CQUFtQixFQUFBO0VBdEIzQjtJQTJCUSx3QkFBd0I7SUFLeEIseUJBQXlCO0lBQ3pCLGNBQWM7SUFDZCxnQkFBZ0I7SUFFaEIseUJBQXlCLEVBQUE7SUFSekI7TUE1QlI7UUE2QlkseUJBQXlCLEVBQUEsRUFnQmhDO0lBN0NMO01BdUNZLG9CQUFpQjtTQUFqQixpQkFBaUI7TUFDakIsc0JBQXNCO01BQ3RCLHVCQUF1QjtNQUN2QixnQkFBZ0I7TUFDaEIsWUFBWSxFQUFBO0VBM0N4QjtJQStDUSxZQUFZO0lBRVosV0FBVztJQUNYLGVBQWU7SUFDZixrQkFBaUIsRUFBQTtJQW5EekI7TUFzRFksZUFBZTtNQUNmLFlBQVk7TUFDWixlQUFlLEVBQUE7O0FBTTNCO0VBQ0kscUJBQWEsRUFBQTs7QUFFakI7RUFDSSxxQkFBYSxFQUFBOztBQUVqQjtFQUNJLHFCQUFhLEVBQUE7O0FBRWpCO0VBQ0kscUJBQWEsRUFBQTs7QUFFakI7RUFDSSx3QkFBd0I7RUFDeEIsK0JBQStCLEVBQUE7RUFGbkM7SUFJUSxtQ0FBbUM7SUFDbkMsWUFBWSxFQUFBIiwiZmlsZSI6InNuaXBwZXQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gQGltcG9ydCBcInRoZW1lL2ludGVycmVnX2N1c3RvbV9ib290c3RyYXA0XCI7IC8vIDwtLS0tLS0tLS0gQWRkIHlvdXIgdmFyaWFibGVzIGludG8gdGhpcyBmaWxlLiBBbHNvIGFkZCB2YXJpYWJsZXMgdG8gb3ZlcndyaXRlIEJvb3RzdHJhcCBvciBVbmRlclN0cmFwIHZhcmlhYmxlcyBoZXJlXG4vLyBAaW1wb3J0IFwiYXNzZXRzL2ZvbnQtYXdlc29tZVwiOyAvLyA8LS0tLS0tLSBGb250IEF3ZXNvbWUgSWNvbiBmb250XG4vLyBAaW1wb3J0IFwidGhlbWUvMV9jdXN0b21fZ2VuZXJpY1wiO1xuLy8gQGltcG9ydCBcInRoZW1lLzJfY3VzdG9tX2NvbnRhaW5lcnNcIjtcbi8vIEBpbXBvcnQgXCJ0aGVtZS80X2N1c3RvbV9vdGhlcl9jb21wb25lbnRzXCI7XG5cbi8vIEBpbXBvcnQgXCIuLi9nbG9iYWwtdGVtcGxhdGVzL21hcC1wbHVnaW4vY3NzL2ludGVycmVnLW1hcFwiO1xuLy8gQGltcG9ydCB1cmwoXCIuLi9zcmMvY3NzL2ZsYWdzLmNzc1wiKTtcblxuQGltcG9ydCB1cmwoJ2h0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzMj9mYW1pbHk9RGlkYWN0K0dvdGhpYyZkaXNwbGF5PXN3YXAnKTtcblxuLmNvbnRhaW5lciB7XG4gICAgbWF4LXdpZHRoOiBub25lO1xufVxuLmNvbnRhaW5lci1jb250ZW50IHtcbiAgICBtYXgtd2lkdGg6IDEwMCU7XG4gICAgd2lkdGg6IDc2MHB4O1xuICAgIG1hcmdpbjogYXV0bztcbiAgICBmb250LWZhbWlseTogJ0RpZGFjdCBHb3RoaWMnLCBzYW5zLXNlcmlmO1xuICAgIG92ZXJmbG93OiBzY3JvbGw7XG4gICAgaGVpZ2h0OiAxMDAlO1xuXG4gICAgaWZyYW1lIHtcbiAgICAgICAgd2lkdGg6IDEwMCU7XG4gICAgICAgIGhlaWdodDogYXV0bztcbiAgICAgICAgbWluLWhlaWdodDogMzUwcHg7XG4gICAgfVxuICAgIC5jb250ZW50LXRleHQge1xuICAgICAgICBtYXgtd2lkdGg6IDYwMHB4O1xuICAgIH1cbn1cbnAgeyB3aWR0aDogMTAwJSA7IH1cbmlmcmFtZSB7IFxuICAgIGhlaWdodDogY2FsYygxMDB2aCAtIDUwcHgpO1xuICAgIC8vIG1pbi1oZWlnaHQ6IDYwMHB4O1xufVxuLnRhYiB7XG4gICAgcG9zaXRpb246IGFic29sdXRlO1xuICAgIG1hcmdpbi10b3A6IC0yOHB4O1xuICAgIGJhY2tncm91bmQ6IHdoaXRlO1xuICAgIHBhZGRpbmc6IDVweCAxMHB4O1xuICAgIGJvcmRlci1yYWRpdXM6IDAgNXB4IDAgMDtcbiAgICBmb250LWZhbWlseTogc2Fucy1zZXJpZjtcbiAgICBmb250LXdlaWdodDogYm9sZDtcbiAgICBib3gtc2hhZG93OiA1cHggLTRweCA2cHggcmdiYSgwLDAsMCwwLjIpO1xufVxuLmxpbmtzLWNvbnRhaW5lciB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmciAxZnIgMWZyIDFmcjtcbiAgICBhIHtcbiAgICAgICAgZGlzcGxheTogZmxleDtcbiAgICAgICAgZmxleC1ncm93OiAxO1xuICAgICAgICBoZWlnaHQ6IDMwcHg7XG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICAgICAgICBwYWRkaW5nOiAycHggMTBweDtcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICAgICAgICBib3JkZXItcmFkaXVzOiA1cHg7XG4gICAgICAgIGZvbnQtZmFtaWx5OiBzYW5zLXNlcmlmO1xuICAgICAgICBmb250LXNpemU6IDEwcHQ7XG4gICAgICAgIG1pbi13aWR0aDogMTAwcHg7XG4gICAgICAgIGNvbG9yOiAjNzQyNjcwO1xuICAgICAgICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gICAgICAgIG1hcmdpbi1yaWdodDogMnB4O1xuICAgICAgICAmOmhvdmVyIHtcbiAgICAgICAgICAgIGNvbG9yOiAjMzMxMTMxO1xuICAgICAgICAgICAgYm9yZGVyLWNvbG9yOiAjMzMxMTMxOztcbiAgICAgICAgfVxuICAgIH1cbn1cbmh0bWwsIGJvZHkge1xuICAgIG92ZXJmbG93OiBoaWRkZW47XG59XG5cblxuXG4vLyB0aGluZ3MgZm9yIHRlc2ltXG4kaGVpZ2h0LXNtOiAzMDsgICAgIC8vIGluIG1vYmlsZVxuJGhlaWdodDogOTA7ICAgICAgICAvLyBpbiBwcmV2aWV3IGRlc2t0b3BcbiRob3ZlcmhlaWdodDogMjYwOyAgLy8gd2hlbiBob3ZlcmluZyBhbmQgZXhwYW5kaW5nXG4ua2VlcC1saW5rIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICAgIHdpZHRoOiAyNTBweDtcbiAgICBtYXgtd2lkdGg6IDI1JTtcbiAgICBoZWlnaHQ6ICRoZWlnaHQtc20gKyBweCAhaW1wb3J0YW50O1xuICAgIG1hcmdpbi10b3A6IGNhbGMoICN7JGhlaWdodC1zbX1weCAqIC0xICsgMzBweCApOyBcbiAgICB6LWluZGV4OiA5O1xuICAgIGJhY2tncm91bmQ6IHdoaXRlO1xuICAgIFxuICAgIEBtZWRpYSAobWluLXdpZHRoOiA1NzZweCkge1xuICAgICAgICBoZWlnaHQ6ICRoZWlnaHQgKyBweCAhaW1wb3J0YW50O1xuICAgICAgICBtYXJnaW4tdG9wOiBjYWxjKCAjeyRoZWlnaHR9cHggKiAtMSArIDMwcHggKTsgXG4gICAgICAgIHRyYW5zaXRpb246IGFsbCAxcztcblxuICAgICAgICAmOmhvdmVyIHtcbiAgICAgICAgICAgIC8vIG9wZW4gdGhlIG1hcFxuICAgICAgICAgICAgaGVpZ2h0OiAkaG92ZXJoZWlnaHQgKyBweCAhaW1wb3J0YW50O1xuICAgICAgICAgICAgbWFyZ2luLXRvcDogY2FsYyggI3skaG92ZXJoZWlnaHR9cHggKiAtMSArIDMwcHggKTsgXG4gICAgICAgIH1cbiAgICB9XG5cbiAgICAmOmhvdmVyIHtcbiAgICAgICAgYmFja2dyb3VuZDogI2RmZDhkODtcblxuICAgIH1cbiAgICAubWFwLXRodW1ibmFpbCB7XG5cbiAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xuICAgICAgICBAbWVkaWEgKG1pbi13aWR0aDogNTc2cHgpIHtcbiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgICAgIH1cblxuICAgICAgICB3aWR0aDogY2FsYyggMTAwJSArIDEycHgpO1xuICAgICAgICBkaXNwbGF5OiBibG9jaztcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDBweDtcbiAgICAgICAvLyBiYWNrZ3JvdW5kOiBibHVlO1xuICAgICAgICBoZWlnaHQ6IGNhbGMoMTAwJSAtIDMwcHgpO1xuICAgICAgICBcbiAgICAgICAgaW1nIHsgLy8gbWFwXG4gICAgICAgICAgICBvYmplY3QtZml0OiBjb3ZlcjtcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGdyYXk7XG4gICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gOHB4KTtcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAzcHg7XG4gICAgICAgICAgICBoZWlnaHQ6IDEwMCU7XG4gICAgICAgIH1cbiAgICB9XG4gICAgLmJ1dHRvbi1ib3R0b20ge1xuICAgICAgICBoZWlnaHQ6IDMwcHg7XG4gICAgICAgIC8vIGJhY2tncm91bmQ6IGdyZWVuO1xuICAgICAgICB3aWR0aDogMTAwJTtcbiAgICAgICAgbWFyZ2luLXRvcDogMHB4O1xuICAgICAgICB0ZXh0LWFsaWduOmNlbnRlcjtcbiAgICAgICAgaW1nIHtcbiAgICAgICAgICAgIC8vIGJvcmRlcjogMXB4IHNvbGlkIGdyYXk7XG4gICAgICAgICAgICBtYXJnaW4tdG9wOiA3cHg7XG4gICAgICAgICAgICBoZWlnaHQ6IDEwMCU7XG4gICAgICAgICAgICBtYXgtd2lkdGg6IDEwMCU7XG4gICAgICAgIH1cbiAgICB9XG59XG5cblxuYm9keS5lbnZpcm9ubWVudCB7XG4gICAgLS1saW5rLWNvbG9yOiAjNWFhMDVkO1xufVxuYm9keS5wMnAge1xuICAgIC0tbGluay1jb2xvcjogIzk2MmM2YTtcbn1cbmJvZHkuaW5mcmFzdHJ1Y3R1cmVzIHtcbiAgICAtLWxpbmstY29sb3I6ICNjOTQ4M2U7XG59XG5ib2R5LmVjb25vbWljYWwge1xuICAgIC0tbGluay1jb2xvcjogIzJlNjE3Zjtcbn1cbi5saW5rLWJvdHRvbS5saW5rLXRleHQge1xuICAgIGNvbG9yOiB2YXIoLS1saW5rLWNvbG9yKTtcbiAgICBib3JkZXItY29sb3I6IHZhcigtLWxpbmstY29sb3IpO1xuICAgICY6aG92ZXIge1xuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB2YXIoLS1saW5rLWNvbG9yKTtcbiAgICAgICAgY29sb3I6IHdoaXRlO1xuICAgIH1cbn0iXX0= */

	</style>
</head>
<body class='container <?php echo ($a = get_field('thematic'))? $a : ''; ?>'>
<?php 

    while ( have_posts() ) : the_post(); 
	

	// setup feat img. In Tesim it is the map of the project.
	$feat_img_url = get_field('map_image');
	$feat_img_url = (strlen($feat_img_url)? $feat_img_url : get_field('map_image_url'));
	// $feat_img = $external_feat_img?? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	// if (is_array($feat_img)) {
	// 	$landscape = ($feat_img[2] > $feat_img[1]) && $feat_img[1] > 600;
	// 	$feat_img_url = $feat_img[0];
	// }
	// else $feat_img_url = $feat_img;
	
	$pdf_link = get_field('pdf_upload');
	$pdf_link = $pdf_link? $pdf_link : get_field('pdf_url');

	?>
	<div class='row bg-white py-2'>
		<div class='col-12 d-flex align-items-start flex-column flex-grow-1 border-dark p-3'>
			<?php
			if ($pdf_link) :
 			?>
			<iframe onload="" 
					id="pdf-iframe" style="width: 100%;" src="<?php echo $pdf_link;?>">				
			</iframe>
			<?php else: ?>
				<div class='container-content'>
					<?php if ($pdf_link) { ?>
						<iframe frameborder="0" allowfullscreen="true" 
							src="<?php echo $pdf_link; ?>"></iframe>
					<?php 
					} ?>
					<?php // the_content(); ?>
				</div>
			<?php
			endif ?>
			
			<div class='links-container'>
				<?php
					$links = get_field('links');
					// echo "<pre>";
					// print_r( htmlentities( $links ));
					// echo "</pre>";
					$links = explode(PHP_EOL, $links);
					
					foreach ($links as $i => $link) 
					if (!empty(trim($link))){
						$text_link = explode('http', $link);
						$text = $text_link[0];
						$link = 'http' . $text_link[1];

						if ($i === 0 && strpos($link, 'https://keep.eu') !== false ) {
							?>
							<a href='<?php echo $link;?>' target="_blank" class="keep-link link-bottom">
							<?php if ($feat_img_url)  : ?>
								<div class="map-thumbnail">
									<img src="<?php echo $feat_img_url; ?>" class='mini-map'/>
								</div>
							<?php endif; ?>
								<div class="button-bottom">
									<img src="<?php 
											 echo get_stylesheet_directory_uri(); ?>/img/keep-eu-logo-transparent.png" 
										 class="keep-eu-logo" />
									
										
								</div>
							</a>
							<?php
						}else {
						?>
						<a 	class="link-bottom link-text"
							href='<?php echo $link;?>' target="_blank"><?php
							$text = preg_replace('/[ ]{2,}|[\t]/', ' ', trim($text)); // Website:
							if (strpos($text, ':') > 0  ) {
						 		echo substr($text, 0, strpos($text, ':')); // remove last colon if any 
							} else echo $text;
								 
						?></a>
						<?php
						}
					}
				?>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</body>
<script>

	// window.open("https://google.com", "_blank");


	// lazyload by default in wp, it's not working here, so I create it manually
	const images = document.querySelectorAll('.lazyload');
	images.forEach( function (img, i) {
		// console.log(img);
		img.setAttribute('src', img.dataset.src);
	});


	theScrollEvent = function () {
		const frm = document.getElementById('pdf-iframe').contentWindow;
		// alert(frm);
	}
	
	
	// this doesnt work
	const pdf_iframe = document.querySelector('#pdf-iframe');
	if (pdf_iframe)
		pdf_iframe.
		   addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
			console.log('scrolling');
			var st = document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
			if (st > lastScrollTop){
				// downscroll code
				document.body.classList.add('scroll-up');
				document.body.classList.remove('scroll-down');
			} else {
				document.body.classList.remove('scroll-up');
				document.body.classList.add('scroll-down');
				// upscroll code
			}
			lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
		}, false);

</script>
</html>