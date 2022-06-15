<?php
session_start();

		
if(isset($_SESSION["UserType"])){
	if ($_SESSION["UserType"]=="Admin"){

		
		
if (isset($_GET['RemoveAPI']))
{$RemoveAPI=$_GET['RemoveAPI'];
	require_once '../include/db_manage.php';
	$db = new DB_manage();
	$db->Remove_API($RemoveAPI);
	if ($db===true){
		echo'<script>
		window.location.replace("apis.php");</script>';
				}
			else{
			echo'<script>
		alert("This API Can not be deleted because it is used in landing pages");</script>';}	
		}
	

		if(isset($_POST['EditAPI'])){
			require_once '../include/db_manage.php';
				$APIID = $_POST['APIID'];
				$APIName = $_POST['APIName'];
				$APILink = $_POST['APILink'];
				$db1 = new DB_manage();
				$db1->Update_API($APIID,$APIName,$APILink);
				if ($db1===false){
		
			echo'<script>
		alert("wrong");</script>';}	
		}

require_once '../include/db_display.php';
// connecting to database
$db = new DB_Display();
$db->API_Display();

?>
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>

<script>
function EditAPI(APIID,APIName,APILink){
	document.getElementById("APIID").value = APIID; 
	document.getElementById("APIName").value = APIName; 
	document.getElementById("APILink").value = APILink; 
}
</script>
<script>
function myFunction() {
event.preventDefault();
alert("This feature still unavailable");
}
</script>
<meta charset="utf-8" />
<title> | APIs</title>
<meta name="description" content="APIS" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="canonical" href="https://keenthemes.com/metronic" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
<link href=".././assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href=".././assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href=".././assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
<link href=".././assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href=".././assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
<link href=".././assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
<link href=".././assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
<link href=".././assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href=".././assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
<!--begin::Logo-->
<a href="dashboard.php">
<img alt="Logo" src=".././assets/media/logos/logo-light.png" />
</a>
<!--end::Logo-->
<!--begin::Toolbar-->
<div class="d-flex align-items-center">
<!--begin::Aside Mobile Toggle-->
<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
<span></span>
</button>
<!--end::Aside Mobile Toggle-->
<!--begin::Header Menu Mobile Toggle-->
<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
<span></span>
</button>
<!--end::Header Menu Mobile Toggle-->
<!--begin::Topbar Mobile Toggle-->
<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
<span class="svg-icon svg-icon-xl">
<!--begin::Svg Icon | path:.././assets/media/svg/icons/General/User.svg-->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24" />
<path
d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
fill="#000000" fill-rule="nonzero" opacity="0.3" />
<path
d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
fill="#000000" fill-rule="nonzero" />
</g>
</svg>
<!--end::Svg Icon-->
</span>
</button>
<!--end::Topbar Mobile Toggle-->
</div>
<!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
<!--begin::Page-->
<div class="d-flex flex-row flex-column-fluid page">
<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
<!--begin::Brand-->
<div class="brand flex-column-auto" id="kt_brand">
<!--begin::Logo-->
<a href="dashboard.php" class="brand-logo">
<h1></h1>

</a>
<!--end::Logo-->
<!--begin::Toggle-->
<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
<span class="svg-icon svg-icon svg-icon-xl">
<!--begin::Svg Icon | path:.././assets/media/svg/icons/Navigation/Angle-double-left.svg-->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24" />
<path
d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
fill="#000000" fill-rule="nonzero"
transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
<path
d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
fill="#000000" fill-rule="nonzero" opacity="0.3"
transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
</g>
</svg>
<!--end::Svg Icon-->
</span>
</button>
<!--end::Toolbar-->
</div>
<!--end::Brand-->
<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
<!--begin::Menu Container-->
<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
data-menu-dropdown-timeout="500">
<!--begin::Menu Nav-->
<ul class="menu-nav">
<li class="menu-item menu-item-active" aria-haspopup="true">
<a href="dashboard.php" class="menu-link">
<span class="svg-icon menu-icon">
<!--begin::Svg Icon | path:.././assets/media/svg/icons/Design/Layers.svg-->
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24" />
<path
d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
fill="#000000" fill-rule="nonzero" />
<path
d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
fill="#000000" opacity="0.3" />
</g>
</svg>
<!--end::Svg Icon-->
</span>
<span class="menu-text">Dashboard</span>
</a>
</li>
<li class="menu-section">
<h4 class="menu-text">Custom</h4>
<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
</li>

<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
<a href="javascript:;" class="menu-link menu-toggle">
<span class="svg-icon menu-icon">
<!--begin::Svg Icon | path:.././assets/media/svg/icons/Shopping/Barcode-read.svg-->
<svg xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24" />
<rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
<path
d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
fill="#000000" fill-rule="nonzero" />
</g>
</svg>
<!--end::Svg Icon-->
</span>
<span class="menu-text">Menu</span>
<i class="menu-arrow"></i>
</a>
<div class="menu-submenu">
<i class="menu-arrow"></i>
<ul class="menu-subnav">
<li class="menu-item menu-item-parent" aria-haspopup="true">
<span class="menu-link">
<span class="menu-text">Menu</span>
</span>
</li>
<li class="menu-item menu-item-submenu" aria-haspopup="true"
data-menu-toggle="hover">
<a href="javascript:;" class="menu-link menu-toggle">
<i class="menu-bullet menu-bullet-dot">
<span></span>
</i>
<span class="menu-text">Main Menu</span>
<i class="menu-arrow"></i>
</a>
<div class="menu-submenu">
<i class="menu-arrow"></i>
<ul class="menu-subnav">
<li class="menu-item" aria-haspopup="true">
<a onclick="window.location.href='domains.php';"
href="domains.php" class="menu-link">
<i class="menu-bullet menu-bullet-dot">
<span></span>
</i>
<span class="menu-text">Domains</span>
</a>
</li>
<li class="menu-item" aria-haspopup="true">
<a onclick="window.location.href='apis.php';"
href="apis.php" class="menu-link">
<i class="menu-bullet menu-bullet-dot">
<span></span>
</i>
<span class="menu-text">APIs</span>
</a>
</li>

<li class="menu-item" aria-haspopup="true">
<a onclick="window.location.href='backurls.php';"
href="backurls.php" class="menu-link">
<i class="menu-bullet menu-bullet-dot">
<span></span>
</i>
<span class="menu-text">Back Urls</span>
</a>
</li>
<li class="menu-item" aria-haspopup="true">
<a onclick="window.location.href='users.php';"
 href="users.php" class="menu-link">
<i class="menu-bullet menu-bullet-dot">
<span></span>
</i>
<span class="menu-text">Users</span>
</a>
</li>
</ul>
</div>
</li>


</ul>
</div>
</li>

</ul>
<!--end::Menu Nav-->
</div>
<!--end::Menu Container-->
</div>
</div>
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
<!--begin::Container-->
<div class="container-fluid d-flex align-items-stretch justify-content-between">
<!--begin::Header Menu Wrapper-->
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
<!--begin::Header Menu-->
<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
<!--begin::Header Nav-->
<ul class="menu-nav">
<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
<a onclick="window.location.href='domains.php';" href="domains.php" class="menu-link menu-toggle">
<span class="menu-text">Domains</span>
<i class="menu-arrow"></i>
</a>

</li>
<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active"
data-menu-toggle="click" aria-haspopup="true">
<a onclick="window.location.href='apis.php';" href="apis.php" class="menu-link menu-toggle">
<span class="menu-text">APIs</span>
<i class="menu-arrow"></i>
</a>

</li>

<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
aria-haspopup="true">
<a onclick="window.location.href='backurls.php';" href="backruls.php" class="menu-link menu-toggle">
<span class="menu-text">Back URLs</span>
<i class="menu-arrow"></i>
</a>

</li>
<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
aria-haspopup="true">
<a onclick="window.location.href='users.php';" href="users.php" class="menu-link menu-toggle">
<span class="menu-text">Users</span>
<i class="menu-arrow"></i>
</a>

</li>
</ul>
<!--end::Header Nav-->
</div>
<!--end::Header Menu-->
</div>
<!--end::Header Menu Wrapper-->
<!--begin::Topbar-->
<div class="topbar">

<!--begin::Languages-->
<div class="dropdown">
<!--begin::Toggle-->
<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-10">
<span
class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
<span
class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php echo $_SESSION['FirstName']?></span>
<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
<span class="symbol-label font-size-h5 font-weight-bold"><?php echo $_SESSION['FirstName'][0]?></span>
</span>
</div>
</div>
<!--end::Toggle-->
<!--begin::Dropdown-->
<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
<!--begin::Nav-->
<ul class="navi navi-hover py-4">
<!--begin::Item-->
<li class="navi-item">
<a href="../logout.php" class="navi-link">
<span class="navi-text">Logout</span>
</a>
</li>
<!--end::Item-->
</ul>
<!--end::Nav-->
</div>
<!--end::Dropdown-->
</div>
<!--end::Languages-->
</div>
<!--end::Topbar-->
</div>
<!--end::Container-->
</div>
<!--end::Header-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->

<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container">

<!--end::Notice-->
<!--begin::Card-->
<div class="card card-custom">
<div class="card-header flex-wrap border-0 pt-6 pb-0">
<div class="card-title">
<h3 class="card-label">APIs Table</h3>
</div>
<div class="card-toolbar">
<!--begin::Dropdown-->

<!--end::Dropdown-->
<!--begin::Button-->


<!-- Button trigger modal-->
<button type="button" class="btn btn-primary" data-toggle="modal"
data-target="#exampleModal">
Add API
</button>

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">unavailable</h5>
<button type="button" class="close" data-dismiss="modal"
aria-label="Close">
<i aria-hidden="true" class="ki ki-close"></i>
</button>
</div>
<div class="modal-body">
This feature still unavailable
</div>
<div class="modal-footer">
<button type="button" class="btn btn-light-primary font-weight-bold"
data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<!--end::Button-->
</div>
</div>
<div class="card-body">
<!--begin: Search Form-->
<!--begin::Search Form-->
<div class="mb-7">
<div class="row align-items-center">
<div class="col-lg-9 col-xl-8">
<div class="row align-items-center">
<div class="col-md-4 my-2 my-md-0">
<div class="input-icon">
<input type="text" class="form-control" placeholder="Search..."
id="kt_datatable_search_query" />
<span>
<i class="flaticon2-search-1 text-muted"></i>
</span>
</div>
</div>


</div>
</div>
<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
<a  class="btn btn-light-primary px-6 font-weight-bold">Search</a>
</div>
</div>
</div>
<!--end::Search Form-->
<!--end: Search Form-->
<!--begin: Datatable-->
<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
<!--end: Datatable-->

<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabels" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit API</h5>
<button type="button" class="close" data-dismiss="modal"
aria-label="Close">
<i aria-hidden="true" class="ki ki-close"></i>
</button>
</div>
<div class="modal-body">
<form class="form" action="apis.php"  method="POST">
<div class="card-body">
<div class="form-group">
<input id="APIID" type="hidden" name="APIID" >
<label>API Name:</label>
<input id="APIName" type="text" name="APIName" 
class="form-control form-control-solid"
placeholder="enter your API Name" />
<span class="form-text text-muted">Please enter your
API Name</span>
</div>
<div class="form-group">
<label>API Link</label>
<input type="text" id="APILink" name="APILink"
class="form-control form-control-solid"
placeholder="enter your API Link" />
<span class="form-text text-muted">Please enter your API 
link</span>
</div>
</div>
<div class="card-footer">
<button type="submit" name="EditAPI"
class="btn btn-primary mr-2">Submit</button>
<button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<!--end::Card-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<?php
}}
else 
{header("refresh:0,url=../index.php");
die();}?>

<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
<!--begin::Container-->
<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
<!--begin::Copyright-->
<div class="text-dark order-2 order-md-1">
<span class="text-muted font-weight-bold mr-2">2021©</span>

</div>
<!--end::Copyright-->
<!--begin::Nav-->
<div class="nav nav-dark">
</div>
<!--end::Nav-->
</div>
<!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->

<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src=".././assets/plugins/global/plugins.bundle.js"></script>
<script src=".././assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src=".././assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src=".././assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src=".././assets/js/pages/widgets.js"></script>
<script src="./.././assets/js/apistable.js"></script>

<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>