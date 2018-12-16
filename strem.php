<?php 
error_reporting(1);
if ( !isset( $_GET['id'] ) || !$_GET['id'] ) {
	header( 'Content-Type: application/json' );
	$log = array(
		'error' => true,
		'message' => 'Masukkan ID Anda'
	);
	exit( json_encode( $log ) );
}
$id = $_GET['id'];
$url = file_get_contents('https://www.mp4upload.com/embed-'.$id.'.html'); 
$mp4u = explode('quot', $url);
$mp4u = explode('|282', $mp4u[1]);
$mp4upload = explode('video|', $mp4u[0]);
$post = explode('|frame1', $url);
$post = explode('|', $post[1]);
$www = explode('|100', $url);
$www = explode('|', $www[2]); 
$poster = ('https://'.$www[1].'.mp4upload.com/i/'.$www[37].'/'.$post[5].'.jpg');
$file = ("{'file':'https://".$www[1].".mp4upload.com:282/d/".$mp4upload[1]."/video.mp4','type':'video/mp4'}");
?>
<!DOCTYPE html>
<html>
   <head>
      <title>MP4Upload Player BETA</title>
      <link rel="icon" href="//www.mp4upload.com/images/favicon.gif" type="image/x-icon"/>
      <meta name="robots" content="noindex"/>
      <meta name="googlebot" content="noindex"/>
      <meta name="referrer" content="never"/>
      <meta name="referrer" content="no-referrer"/>
      <meta name="author" content="Iqbal Rifai"/>
      <script src="//ssl.p.jwpcdn.com/player/v/7.11.2/jwplayer.js"></script>
      <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
      <style>*{margin:0px;}html{overflow:hidden;}</style>
   </head>
   <body>
      <div id="mp4upload"></div>
      <script>
         jwplayer.key = "CKjOe06GxAOe3Dj9NaWPCQKtqvqQdyFV8z9wsg==";
         var MP4Play = jwplayer("mp4upload");
         MP4Play.setup({
         sources: [<?php echo $file?>],
         image: '<?php echo $poster?>',
         preload: 'auto',
         primary: 'html5',
         width: $(window).width(),
         height: $(window).height()
         })
         $(document).ready(function(){
         $(window).resize(function(){
         jwplayer().resize($(window).width(),$(window).height())
         })
         })
      </script>
   </body>
</html>
