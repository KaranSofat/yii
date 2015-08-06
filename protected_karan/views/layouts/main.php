<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/light/theme.css" rel="stylesheet" type="text/css" media="all" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/editor.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendar.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/elfinder.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/datatables.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Alert.js"></script>

<!-- start top js_button -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Alert.js"></script>
<!-- strat-slider -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Breadcrumb.js"></script>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Calendar.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Chart.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Color.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Date.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Editor.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_File.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Dialog.js></script>

<!-- start top js_button -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Form.js"></script>
<!-- strat-slider -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Gallery.js"></script>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Multiselect.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Number.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Password.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Slider.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Store.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Time.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Valid.js></script>

<!-- start top js_button -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/wl_Widget.js"></script>
<!-- strat-slider -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/config.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>


<!-- strat-slider -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/media.css" rel="stylesheet" type="text/css" media="screen" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
				<div id="pageoptions">
			<ul>
				<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/login">Logout</a></li>
				<li><a href="#" id="wl_config">Configuration</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
			<div>
						<h3>Place for some configs</h3>
						<p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores.</p>
			</div>
		</div>

			<header>
		<div id="logo">
			<a href="test.html">Logo Here</a>
		</div>
		<div id="header">
			<ul id="headernav">
				<li><ul>
					<li><a href="icons.html">Icons</a><span>300+</span></li>
					<li><a href="#">Submenu</a><span>4</span>
						<ul>
							<li><a href="#">Just</a></li>
							<li><a href="#">another</a></li>
							<li><a href="#">Dropdown</a></li>
							<li><a href="#">Menu</a></li>
						</ul>
					</li>
					<li><a href="login.html">Login</a></li>
					<li><a href="wizard.html">Wizard</a><span>Bonus</span></li>
					<li><a href="#">Errorpage</a><span>new</span>
						<ul>
							<li><a href="error-403.html">403</a></li>
							<li><a href="error-404.html">404</a></li>
							<li><a href="error-405.html">405</a></li>
							<li><a href="error-500.html">500</a></li>
							<li><a href="error-503.html">503</a></li>
						</ul>
					</li>
				</ul></li>
			</ul>
			<div id="searchbox">
				<form id="searchform" autocomplete="off">
					<input type="search" name="query" id="search" placeholder="Search">
				</form>
			</div>
			<ul id="searchboxresult">
			</ul>
		</div>
	</header>

				<nav>
			<ul id="nav">
				<li class="i_house"><a href="dashboard.html"><span>Dashboard</span></a></li>
				<li class="i_book"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/users"><span>Users</span></a>
				         
				<!--	<ul>
						<li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
						<li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
						<li><a href="doc-calendar.html"><span>Calendar</span></a></li>
						<li><a href="doc-charts.html"><span>Charts</span></a></li>
						<li><a href="doc-dialog.html"><span>Dialog</span></a></li>
						<li><a href="doc-editor.html"><span>Editor</span></a></li>
						<li><a href="doc-file.html"><span>File</span></a></li>
						<li><a href="doc-fileexplorer.html"><span>Fileexplorer</span></a></li>
						<li><a href="doc-form.html"><span>Form</span></a></li>
						<li><a href="doc-gallery.html"><span>Gallery</span></a></li>
						<li><a href="doc-inputfields.html"><span>Inputfields</span></a></li>
						<li><a href="doc-slider.html"><span>Slider</span></a></li>
						<li><a href="doc-store.html"><span>Store</span></a></li>
						<li><a href="doc-widget.html"><span>Widget</span></a></li>
					</ul>
				</li>
				<li class="i_create_write"><a href="form.html"><span>Form</span></a></li>
				<li class="i_graph"><a href="charts.html"><span>Charts</span></a></li>
				<li class="i_images"><a href="gallery.html"><span>Gallery</span></a></li>
				<li class="i_blocks_images"><a href="widgets.html"><span>Widgets</span></a></li>
				<li class="i_breadcrumb"><a href="breadcrumb.html"><span>Breadcrumb</span></a></li>
				<li class="i_file_cabinet"><a href="fileexplorer.html"><span>Fileexplorer</span></a></li>
				<li class="i_calendar_day"><a href="calendar.html"><span>Calendar</span></a></li>
				<li class="i_speech_bubbles_2"><a href="dialogs_and_buttons.html"><span>Dialogs &amp; Buttons</span></a></li>
				<li class="i_table"><a href="datatable.html"><span>Table</span></a></li>
				<li class="i_typo"><a href="typo.html"><span>Typo</span></a></li>
				<li class="i_grid"><a href="grid.html"><span>Grid</span></a></li>
			</ul>-->
		</nav>
		
		

	<?php echo $content; ?>
		
		
		<footer>Copyright by revaxarts.com 2011</footer>
</body>
</html>
