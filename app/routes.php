<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




/**
 * Admin management routes
 */
Route::group(array('prefix' => 'admin'), function()
{
	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});


/**
 * Authentication and authorization routes
 */

Route::group(array('prefix' => 'auth'), function()
{
	// Login 
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	// Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	// Account activaiton
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	// Forgot password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	// Forgot password confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');


	// Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));



});



/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(array('prefix' => 'account'), function()
{
	// Account dashboard
	Route::get('/', array('as' => 'account', 'uses' => 'HomeController@showWelcome'));
	
	// Profile 
	Route::get('profile',array('as'=>'profile', 'uses'=>'Controllers\Account\ProfileController@getIndex'));
	// Route::post('profile', 'HomeController@showWelcome');
	Route::post('profile', 'Controllers\Account\ProfileController@postIndex');


	// Change username
	// Change password
	Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
	Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

	// Change email
	Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
	Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

	// View published products
	Route::get('published-items', array('as'=> 'published-items', 'uses' => 'Controllers\Account\ReviewPublishmentController@getPublishedItems')); 
	Route::post('published-items', 'Controllers\Account\ReviewPublishmentController@postIndex');

	// View requested products
	Route::get('requested-items', array('as'=> 'requested-items', 'uses' => 'Controllers\Account\ReviewPublishmentController@getRequestedItems')); 
	Route::post('requested-items', 'Controllers\Account\ReviewPublishmentController@postIndex');

	// Edit published item
	// Route::get('{itemID}', array('as' => 'editSingleItem', 'uses' => 'ItemController@getSingleItemEditForm'))->where('id', '[0-9]+');
	Route::get('revise-item/{itemID}', array('as' => 'reviseSingleItem', 'uses' => 'Controllers\Account\ReviewPublishmentController@getSingleItemEditForm'))->where('id', '[0-9]+');

	Route::post('revise-item/{itemID}', array('as' => 'postRevise', 'uses' =>'Controllers\Account\ReviewPublishmentController@PostSingleItemEditForm'))->where('id', '[0-9]+');

	Route::get('revise-delete/{itemID}', array('as' => 'deleteItem','uses' => 'Controllers\Account\ReviewPublishmentController@deleteItem'))->where('id', '[0-9]+');


});


/*
|--------------------------------------------------------------------------
| Item Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(array('prefix' => 'item'), function()
{
	// Show all items
	Route::get('all', array('as' => 'item', 'uses' => 'ItemController@getAllItems')); 
	// Show all items with specific parent category
	Route::get('all/{parentCategoryId}', array('as' => 'item/category', 'uses' => 'ItemController@getAllItemsWithCategory'))->where('parentCategoryId', '[0-9]+');

	// Show single item, parameter matching with regular expression
	Route::get('{itemID}', array('as' => 'singleItem', 'uses' => 'ItemController@getSingleItem'))->where('itemID', '[0-9]+');


	Route::get('request', array('as' => 'request', 'uses' => 'ItemController@itemRequestProcess'));


});



// Show a single item publish page and Post a single item form
Route::get('publish', array('as' => 'publish/item', 'uses' => 'ItemController@getSingleItemForm')); 
Route::post('publish', 'ItemController@PostSingleItemForm'); 

Route::get('publish-category', array('as' => 'getCategory', function()
{
	if(Input::get('category1_id'))
	{

		$category1_id = Input::get('category1_id');

		$subCategory = Category::where('parent_id', '=', $category1_id)->get();

		return Response::json($subCategory);

	}

	if(Input::get('category2_id'))
	{
		$category2_id = Input::get('category2_id');

		$subCategory = Category::where('parent_id', '=', $category2_id)->get();

		return Response::json($subCategory);
	}

}));



Route::get('publish/process/{id}', array('as' => 'publish/process', 'uses' => 'ItemController@itemPictureProcess'));




/**
 * Search Function
 */
Route::get('search', array('as' => 'search', 'uses' => 'HomeController@searchItem'));






/**
 * Home Page Temp
 */
// Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));
Route::get('/', array('as' => 'home', function(){
	return View::make('coming_soon');
}));

Route::get('request',array('as'=>'tempRuquest', 'uses' => 'HomeController@getRequest'));



/**
 * How to use
 */
Route::get('how-to-use', function(){

	return View::make('frontend.how-to-use');
});

/**
 * About Us & Contact Us
 */

Route::post('contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@getContact'));
Route::get('about-us', array('as' => 'about-us', 'uses' => 'HomeController@getAboutUs'));


/**
 * Test Page 
 */
Route::get('test0', array('as' => 'test', function(){
	return View::make('frontend.test0');
}));

Route::get('test1', array('as' => 'test', function(){
	return View::make('frontend.test1');
}));







