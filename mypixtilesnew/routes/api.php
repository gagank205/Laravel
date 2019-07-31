<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Authenticate Routes */
Route::group(['namespace' => '\App\Http\Controllers\API'], function()
{
	Route::POST('register','UsersApiController@register');
	Route::POST('login','UsersApiController@login');
	Route::POST('otp','UsersApiController@sendotp');
	Route::post('verify-otp','UsersApiController@verifyOTP');
	Route::post('change-password','UsersApiController@changePassword');
	Route::post('skip-login','UsersApiController@skip_login');
	
	Route::post('forgotpassword','ForgotPasswordController@sendEmail');

	//Logout
	Route::post('logout','UsersApiController@logout');

	//My Profile
	Route::POST('myprofile','UsersApiController@myprofile');
	Route::POST('update-profile','UsersApiController@updateprofile');

	//CMS
	Route::GET('cms-terms-conditions','CmsApiController@cmsTerms');
	Route::POST('cms-aboutus-privacy','CmsApiController@cmsAboutusPrivacy');
	Route::POST('cms-contact-us','CmsApiController@cmsContactus');
	Route::POST('faq-list','CmsApiController@faqList');
	
	//Deals route
	Route::POST('add-deal-post','DealPostApiController@addDeal');
	Route::POST('block-member-post','DealPostApiController@blockMemberPost');
	Route::POST('member-deals-list','DealPostApiController@memberDealsList');
	Route::POST('deal-data','DealPostApiController@getDealData');
	Route::POST('update-deal-post','DealPostApiController@updateDeal');
	Route::POST('my-deal-post-list','DealPostApiController@getMyPostList');
	Route::POST('block-post-list','DealPostApiController@blockMemberList');
	Route::POST('unblock-member','DealPostApiController@unblockMember');
	Route::POST('add-review','DealPostApiController@reviewOnPost');

	//Deal like and dislike
	Route::POST('post-like-dislike','DealPostApiController@postLikeDislike');
	
	//table reservation
	Route::POST('table-reservation','TableReservationController@tableReservation');
	
	//deal favorite
	Route::POST('add-to-favorite','DealPostApiController@addToFavorite');
	Route::POST('get-favorite-post-list','DealPostApiController@getFavoritePostList');

	//deal comments
	Route::POST('add-comment','CommentsApiController@addComment');
	Route::POST('list-comment','CommentsApiController@listComment');
	Route::POST('like-dislike-comment','CommentsApiController@likeAndDislikeComment');

	//deal feedback
	Route::POST('add-feedback','FeedbackApiController@addFeedback');
	Route::POST('list-feedback','FeedbackApiController@listFeedback');
	//Route::POST('list-comment','FeedbackApiController@listComment');

	//Category list
	Route::GET('category-list','DealPostApiController@getCategoryList');

	//sub-category list
	Route::POST('sub-category-list','DealPostApiController@getSubcategoryList');
});


