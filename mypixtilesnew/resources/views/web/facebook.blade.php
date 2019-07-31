<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Photos with Friends!</title>
	<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
	<script>
		/**
		 * This is the getPhoto library
		 */
		function makeFacebookPhotoURL( id, accessToken ) {
			return 'https://graph.facebook.com/' + id + '/picture?access_token=1242807732568311|sniL-kdFXOvkmBoTdcczHPx28WI';
		}
		function login( callback ) {
			FB.login(function(response) {
				if (response.authResponse) {
					//console.log('Welcome!  Fetching your information.... ');
					if (callback) {
						callback(response);
					}
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			},{scope: 'user_photos'} );
		}
		function getAlbums( callback ) {
			FB.api(
					'/me/albums',
					{fields: 'id,cover_photo'},
					function(albumResponse) {
						//console.log( ' got albums ' );
						if (callback) {
							callback(albumResponse);
						}
					}
				);
		}
		function getPhotosForAlbumId( albumId, callback ) {
			FB.api(
					'/'+albumId+'/photos',
					{fields: 'id'},
					function(albumPhotosResponse) {
						//console.log( ' got photos for album ' + albumId );
						if (callback) {
							callback( albumId, albumPhotosResponse );
						}
					}
				);
		}
		function getLikesForPhotoId( photoId, callback ) {
			FB.api(
					'/'+albumId+'/photos/'+photoId+'/likes',
					{},
					function(photoLikesResponse) {
						if (callback) {
							callback( photoId, photoLikesResponse );
						}
					}
				);
		}
		function getPhotos(callback) {
			var allPhotos = [];
			var accessToken = '';
			login(function(loginResponse) {
					accessToken = loginResponse.authResponse.accessToken || '';
					getAlbums(function(albumResponse) {
							var i, album, deferreds = {}, listOfDeferreds = [];
							for (i = 0; i < albumResponse.data.length; i++) {
								album = albumResponse.data[i];
								deferreds[album.id] = $.Deferred();
								listOfDeferreds.push( deferreds[album.id] );
								getPhotosForAlbumId( album.id, function( albumId, albumPhotosResponse ) {
										var i, facebookPhoto;
										for (i = 0; i < albumPhotosResponse.data.length; i++) {
											facebookPhoto = albumPhotosResponse.data[i];
											allPhotos.push({
												'id'	:	facebookPhoto.id,
												'added'	:	facebookPhoto.created_time,
												'url'	:	makeFacebookPhotoURL( facebookPhoto.id, accessToken )
											});
										}
										deferreds[albumId].resolve();
									});
							}
							$.when.apply($, listOfDeferreds ).then( function() {
								if (callback) {
									callback( allPhotos );
								}
							}, function( error ) {
								if (callback) {
									callback( allPhotos, error );
								}
							});
						});
				});
		}
	</script>

	<script>
		/**
		 * This is the bootstrap / app script
		 */
		// wait for DOM and facebook auth
		var docReady = $.Deferred();
		var facebookReady = $.Deferred();
		$(document).ready(docReady.resolve);
		window.fbAsyncInit = function() {
			FB.init({
			  appId      : '1242807732568311',
			  channelUrl : '//conor.lavos.local/channel.html',
			  status     : true,
			  cookie     : true,
			  xfbml      : true
			});
			facebookReady.resolve();
		};
		$.when(docReady, facebookReady).then(function() {
			if (typeof getPhotos !== 'undefined') {
				getPhotos( function( photos ) {
					console.log( photos );
					$("#extend_pics").html('');
					for (var item of photos) {
						//photosArr.push({url : item.url});
						$("#extend_pics").append("<div class='' style='float:left;' onClick='socialFunction(this)' data-id='"+item.url+"'><img src='"+item.url+"' style='width:141px;border:5px solid #c3a7a7;' /></div>");
					}
				
				});
			}
		});
		// call facebook script
		(function(d){
		 var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "http://connect.facebook.net/en_US/all.js";
		 d.getElementsByTagName('head')[0].appendChild(js);
		}(document));
	</script>
</head>
<body>
	<div id="fb-root">
	</div>
	<center>
		<div id="extend_pics" style="width: 25%;"></div>
	</center>

</body>
</html>