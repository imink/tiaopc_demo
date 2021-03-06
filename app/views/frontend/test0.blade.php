@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Test By Yue Wang
@parent
@stop

{{-- Page Content --}}
@section('content')



{{-- 02/05/2015 --}}

<?php

// $priceArray = Item::find(13)->prices()->orderBy('created_at','asc')->get();




// var_dump($priceArray);
// $itemPrice = Item::find(13)->prices->to_array();

// var_dump($itemPrice);
// $priceArray['time'] = $itemPrice->lists('created_at');

// $priceArray['price'] = $itemPrice->lists('price');
// $timeList = [];
// foreach ($priceArray['time'] as $time)
// {
//   echo $time;
//   array_push($timeList, $time);
// }

// print_r($timeList);
?>

                    <div class="" id="lineChart" style="opacity: 0;">
                        <h3 class="center">Line Chart</h3>
                        <canvas id="lineChartCanvas" width="547" height="300"></canvas>
                    </div>



<script type="text/javascript">
  
 jQuery(window).load( function(){

    var itemId = 13;


    $.get('{{ URL::route('getPrice')}}', {item_id: itemId}, function(result){

      console.log(result);

      priceArray = new Array();
      timeArray = new Array();
      $.each(result, function(index, price){
        priceArray.push(price.price);
        timeArray.push(price.created_at);
        console.log(timeArray);
      });

    var lineChartData = {
                            // labels : ["January","February","March","April","May","June","July"],
                            labels :timeArray,
                            datasets : [

                                {
                                    fillColor : "rgba(151,187,205,0.5)",
                                    strokeColor : "rgba(151,187,205,1)",
                                    pointColor : "rgba(151,187,205,1)",
                                    pointStrokeColor : "#fff",
                                    // data : [28,48,40,19,96,27,100]
                                    data: priceArray
                                },

                            ]};

                        var globalGraphSettings = {animation : Modernizr.canvas};

                        function showLineChart(){
                            var ctx = document.getElementById("lineChartCanvas").getContext("2d");
                            new Chart(ctx).Line(lineChartData,globalGraphSettings);
                        }

          $('#lineChart').appear( function(){ $(this).css({ opacity: 1 }); setTimeout(showLineChart,300); },{accX: 0, accY: -155},'easeInCubic');

    });





      });


</script>

 <?php


//         $items = Item::where('location', '=', 0);

//         foreach ($items as $item)
//         {

//           // Add the main picture to the item array
//           $itemPicture = Item::find($item->id)->pictures()->where('status','=','1')->first();
//           $pictureName = $itemPicture['picture_name'];
//           array_add($item, "picture_name", $pictureName);

//           // Add the newest price to the item array
//           $priceArray = Item::find($item->id)->prices->first(); 
//           $newestPrice = $priceArray['price'];
//           array_add($item, 'price',$newestPrice);

//         }

//         // $links = $items->links();
//          $items = $items->orderBy('price','ASC')->paginate(2);
 


// foreach ($items as $item)
// {
//   echo $item->price;
// }
?>


{{-- {{ $items->links() }} --}}


<?php


// $categories = [
//   ['id' => 1, 'name' => '个人电脑'],
//   ['id' => 2, 'name' => '外设及配件'],
//   ['id' => 3, 'name' => '手机和平板'],
//   ['id' => 4, 'name' => '摄影器材'],
//   ['id' => 5, 'name' => '其他'],

// ];

// Category::buildTree($categories); // => true


// $cat = Category::all();

// foreach ($cat as $cate){
//   echo $cate->name;
// }


// $items = Item::orderBy('created_at', 'DESC')->normal()->paginate(12);

// var_dump($items);


// $itemWithCategory = Category::find(1)->getChildItem()->orderBy('created_at', 'DESC')->paginate(3);

// $itemWithCategory = Category::find(1)->getChildItem()->orderBy('created_at', 'ASC')->paginate(3);

// $itemWithPrice = Category::find(1)->getChildItem()->get();

// foreach ($itemWithPrice as $item) 
// {
//     // Add the newest price to the item array
//       $priceArray = Item::find($item->id)->prices->first(); 
//       $newestPrice = $priceArray['price'];
//       array_add($item, 'price',$newestPrice);
// }

// $itemArray = $itemWithPrice->orderBy('price', 'DESC')->paginate(3);


$item = Item::where('location', '=', 0)->join('price', 'items.id', '=', 'price.item_id')->orderBy('price.price', 'asc')->get();



// $item = $item->sortByAsc('created_at');



print count($item);






// foreach ($item as $title)
// {
//   var_dump($title->price);
//   var_dump(($title->id));
// }

// var_dump($itemWithPrice);





?>



{{-- 24/03/2015 --}}


<div id="fine-uploader"></div>
<div id="triggerUpload" class="button button-3d button-rounded button-leaf" style="margin-top: 10px;">
  Upload now
</div>


  <script>
  $(document).ready(function () {
    var uploader = $('#fine-uploader').fineUploader({
      template: "qq-template",
      thumbnails: {
          placeholders: {
            waitingPath: "../placeholders/waiting-generic.png",
            notAvailablePath: "../placeholders/not_available-generic.png"
          }
      },
      request: {
        endpoint: 'server/handleUploads'
      },
      validation: {
          allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
      },
      autoUpload: false

    });

    $('#triggerUpload').click(function() {
        uploader.fineUploader('uploadStoredFiles');
    });

  });
</script>
    <script type="text/template" id="qq-template">

        <div class="qq-uploader-selector qq-uploader">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span>Drop files here to upload</span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Cancel</a>
                    <a class="qq-upload-retry-selector qq-upload-retry" href="#">Retry</a>
                    <a class="qq-upload-delete-selector qq-upload-delete" href="#">Delete</a>
                    <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>
        </div>
    </script>









{{--  20/3/2015 --}}
<?php


// Mail::queue('email.notify-request', $array, function($message)
// {
//   $message->to('mail_address', 'Name')->subject('Request Approved Notification | Tiaopc');
// });
// // $itemId = 23;

// // // $tran = Item::find($itemId)->transactions;

// // $tran = Transaction::where('item_id','=',$itemId)->get()->toArray();
// // var_dump($tran);

// // foreach ($tran as $x)
// // {
// //   echo "ok";
// //   var_dump($x->creatd_at);
// // }


// $item = Item::find(23);

// array_add($item, 'transactions', $tran);

// // foreach( $item as $y){
//   var_dump($item->transactions);
// // }

?>












{{-- 20/3/2015 --}}
<!-- Button trigger upload -->
<button class="button button-3d button-mini button-rounded button-red" data-toggle="modal" data-target="#myModal">Requests</button>
<!--Modal-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-body">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Approve Reuqests</h4>
                    </div>
                    <div class="modal-body">
                       <table class="table table-striped">
                       	<thead>
                       		<tr>
                       			<th>Product ID</th>
                       			<th>Product Name</th>
                       			<th>Requested By</th>
                       			<th>When</th>
                       			<th>Action</th>
                       		</tr>

                       		<tbody>
                       			<tr>
                       				{{-- Product ID --}}
                       				<td>ID</td>
                       				{{-- Production Name --}}
                       				<td>Name</td>
                       				{{-- Requested By --}}
                       				<td>Someone</td>
                       				{{-- When --}}
                       				<td>date</td>
                       				{{-- Action --}}
                       				<td><button class="button button-3d button-mini button-rounded button-green">Approve</button></td>
                       			</tr>
                       		</tbody>

                       	</thead>
                       </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>





{{--16/3/2015 --}}

<?php

// foreach ($result as $term)
// {
// 	echo $term->title;
// 	echo "<br>";
// }

?>

{{-- 11/3/2015 --}}
<?php 

// echo Config::get('helper.mail_suffix');


// if(User::find(3)->transactions()->where('item_id', '=', 1)->exists())
// {
// 	echo "ok";
// }

// $tran = User::find(3)->transactions;

// var_dump($tran);

// $user = Item::find(23)->getUser->id;


// echo $user;
// var_dump($user);

// echo phpinfo();

?>







</script>

	



</script>






{{-- 8/3/2015 --}}
<?php
// $category = Category::where('id', '=', '11')->first();
// // 

// $categorySet = $category->getLeaves();

// foreach ($categorySet as $a)
// {
// 	echo $a->name;
// }
	

			// $parentCategory = Item::find(63)->category; 
			
			// while($parentCategory->parent_id != NULL)
			// {
			// 	// Get the current category collection
			// 	$parentCategory = Category::find($parentCategory->parent_id);				
			// }

			// echo $parentCategory->id;



?>





{{-- 7/3/2015 --}}
<?php 
// $img = Image::make('assets/img/2.png');
// // var_dump($img);
// $ratio = 4/3;
// echo intval($img->width()/$ratio);

// Check the current size of img is appropriate or not,
// if ratio of current img is greater than 1.33, then crop
// if(intval($img->width()/$ratio > $img->height()))
// {
// 	// Fit the img to ratio of 4:3, based on the height
// 	$img->fit(intval($img->height() * $ratio),$img->height());
// } 
// else
// {
// 	// Fit the img to ratio of 4:3, based on the width
// 	$img->fit($img->width(), intval($img->width()/$ratio));
// }



// $img->save('assets/img/new2.jpg');



// return Redirect::action('ItemController@itemPictureProcess', array('id' => 1));
			// $path = public_path().'/assets/img';
			// $picture = "ok.jpg";
			// $picturePath =$path."/".$picture;

			// echo $picturePath;
			// 
			
Redirect::action('ItemController@itemPictureProcess', array('id' => 56));


?>

{{-- {{HTML::image('assets/img/new2.jpg')}}  --}}


{{-- 4/3/2015 --}}
<?php

// $item = Item::find(57);

// $price = new Price(['price' => '88']);

// if($item->prices()->save($price))
// {
// 	echo "ok";
// }


// $parentCategory = Category::where('parent_id','=', NULL)->get(); 

// echo $parentCategory;

// foreach ($parentCategory as $category)
// {
// 	echo $category['name'];
// }

// // Get the parent category id by given item
// $category = Item::find(14)->category()->first();

// echo $category->parent_id;



?>






<?php
/*// get child category name
$parentCategory = Category::where('parent_id','=','1')->get(); 
// get all child category id
$categorySet = Category::where('parent_id','=','1')->lists('id'); 

// get all item that contains child category id
$items = Item::whereIn('category_id',$categorySet)->paginate(10); 

// get the main picture of the item
$itemPicture = Item::find(4)->pictures()->where('status','=','1')->first();

$pictureName = $itemPicture['picture_name'];


foreach ($items as $item)
{
	$itemPicture = Item::find($item->id)->pictures()->where('status','=','1')->first();

	$pictureName = $itemPicture['picture_name'];

	$itemArray = array_add($item, "picture_name", $pictureName);

		// Get the newest price
	$priceArray = Item::find($item->id)->prices->first(); 
	// get the first/newest priceArray
	$newestPrice = $priceArray['price'];
	
	$itemArray = array_add($item, 'price',"$newestPrice");

}

echo $itemArray;*/


?>





{{-- 
{{ $items->links() }}
 --}}




















<?php
// $data = Session::all();
// var_dump($data);
// echo "<br>";
// echo "error is ";
// var_dump($errors->first());
// echo "<br>";





// $item = Item::where('category_id', '=', '15')->count();

// $categoryName = Category::where('parent_id','=','1')->get()->toArray();
// $datas = Category::where('parent_id','=','1')->lists('id'); // Given a specifyied attr

// // var_dump($item);

// echo "<pre>", var_dump($datas), "</pre>";



// foreach ($datas as $data){
// 	echo $data;
// }



// $child = Category::find(6)->getChildItem->lists('title');
// 

// $array = array(2,3,4,5,);


// $datas = Category::where('parent_id','=','1')->lists('id'); // get all child category id

// $child = Item::whereIn('category_id',$datas)->lists('title'); // get all item that contains child category id

// var_dump($child);
// $path = asset('assets/img/IMG_0635.jpg');

// echo $path;

// $img = Image::make($path);


// $img->fit(640,640);
// $img->save('assets/img/new.jpg');


// var_dump($img);





// $env = App::environment();

// echo $env;

// echo "<br>";

// echo $_SERVER['SERVER_NAME'];
// $item = User::find(3)->getItems;
// 
// 
// echo gethostname();

// var_dump($item);
// $categories = [
//   ['id' => 1, 'name' => '手机', 'children' => [
// 	  ['id' => 2, 'name' => '苹果'],
// 	  ['id' => 3, 'name' => '三星'],
// 	  ['id' => 4, 'name' => 'HTC'],
// 	  ['id' => 5, 'name' => '其他']
//   ]],
//   ['id' => 6, 'name' => '平板', 'children' => [
// 	  ['id' => 7, 'name' => '苹果'],
// 	  ['id' => 8, 'name' => '联想'],
// 	  ['id' => 9, 'name' => '微软'],
// 	  ['id' => 10, 'name' => '其他']
//   ]],
//   ['id' => 11, 'name' => '电脑', 'children' => [
//       ['id' => 12, 'name' => '台式机', 'children' =>[
//       	['id' => 13, 'name' => '整机'],
//       	['id' => 14, 'name' => 'CPU'],
//       	['id' => 15, 'name' => '内存条'],
//       	['id' => 16, 'name' => '显卡'],
//       	['id' => 17, 'name' => '硬盘'],
//       	['id' => 18, 'name' => '其他']
//       ]],
//       ['id' => 19, 'name' => '笔记本', 'children' =>[
//       	['id' => 20, 'name' => '游戏型'],
//       	['id' => 21, 'name' => '全能型'],
//       	['id' => 22, 'name' => '办公型'],
//       	['id' => 23, 'name' => '其他']
//       ]]
//    ]],
//    ['id' => 24, 'name' => '外设', 'children' => [
//       // These will be created
//       ['id' => 26, 'name' => '鼠标'],
//       ['id' => 27, 'name' => '键盘'],
//       ['id' => 28, 'name' => '耳机'],
//       ['id' => 29, 'name' => '音响'],
//       ['id' => 30, 'name' => '游戏主机'],
//       ['id' => 31, 'name' => '显示器'],
//       ['id' => 32, 'name' => '其他']
//     ]]
// ];

// Category::buildTree($categories); // => true



// $node = Category::get();


// var_dump($node->siblings());


// foreach ($node as $children) 
// {
// 	var_dump($children->name);
// }

// var_dump($node[1]->name);


// $destinationPath ='./public/assets/img/';
// echo public_path().'/assets/img';

// echo $info;
// echo Lang::get('auth/message.test');
 
// echo date("Ymdhis") . str_random(3); 

?>




{{-- {{ HTML::image('assets/img/new.jpg')}} --}}

{{-- {{ HTML::image('assets/img/IMG_0635.jpg')}} --}}



@stop