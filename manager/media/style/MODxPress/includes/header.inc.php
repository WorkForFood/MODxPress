<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");
$mxla = $modx_lang_attribute ? $modx_lang_attribute : 'en';

// invoke OnManagerRegClientStartupHTMLBlock event
$evtOut = $modx->invokeEvent('OnManagerMainFrameHeaderHTMLBlock');
$modx_textdir = isset($modx_textdir) ? $modx_textdir : null;
$onManagerMainFrameHeaderHTMLBlock = is_array($evtOut) ? implode("\n", $evtOut) : '';
$textdir = $modx_textdir==='rtl' ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo  $mxla;?>" dir="<?php echo  $textdir;?>"><head>
	<title>MODX</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $modx_manager_charset; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fontAwesome.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/icoMoon.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fonts.css' type='text/css' media='all' />
	<link rel="stylesheet" href="media/style/<?php echo $modx->config['manager_theme']; ?>/styles/classic-forms.css" type="text/css" media='all' />
	<link rel="stylesheet" href="media/style/<?php echo $modx->config['manager_theme']; ?>/styles/bootstrapGrid.css" type="text/css" media='all' />
	<link rel="stylesheet" href="media/style/<?php echo $modx->config['manager_theme']; ?>/style.css" type="text/css" media='all' />


	<!-- OnManagerMainFrameHeaderHTMLBlock -->
	<?php echo $onManagerMainFrameHeaderHTMLBlock; ?>
	
	<script src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/jquery.js" type="text/javascript"></script>
	<script src="media/script/mootools/mootools.js" type="text/javascript"></script>
	<script src="media/script/mootools/moodx.js" type="text/javascript"></script>
	<script type="text/javascript">

		/* <![CDATA[ */
		window.addEvent('load', document_onload);
		window.addEvent('beforeunload', document_onunload);
		
		function document_onload() {
			stopWorker();
			hideLoader();
<?php
	if(isset($_REQUEST['r'])) echo 'doRefresh(' . $_REQUEST['r'] . ");\n";
?>
		}

		function reset_path(elementName) {
			document.getElementById(elementName).value = document.getElementById('default_' + elementName).innerHTML;
		}

		var dontShowWorker = false;
		function document_onunload() {
			if(!dontShowWorker) {
				top.mainMenu.work();
			}
		}

		// set tree to default action.
		if (parent.tree) parent.tree.ca = "open";

		// call the updateMail function, updates mail notification in top navigation
		if (top.mainMenu) {
			if(top.mainMenu.updateMail) {
				top.mainMenu.updateMail(true);
			}
		}
		
		function stopWorker() {
			try {
				parent.mainMenu.stopWork();
			} catch(oException) {
				ww = window.setTimeout('stopWorker()',500);
			}
		}

		function doRefresh(r) {
			try {
				rr = r;
				top.mainMenu.startrefresh(rr);
			} catch(oException) {
				vv = window.setTimeout('doRefresh()',1000);
			}
		}
		var documentDirty=false;

		function checkDirt(evt) {
			if(documentDirty==true) {
				var message = "<?php echo $_lang['warning_not_saved']; ?>";
				if (typeof evt == 'undefined') {
					evt = window.event;
			}
				if (evt) {
					evt.returnValue = message;
		}
				return message;
			}
		}

		function saveWait(fName) {
			document.getElementById("savingMessage").innerHTML = "<?php echo $_lang['saving']; ?>";
			for(i = 0; i < document.forms[fName].elements.length; i++) {
				document.forms[fName].elements[i].disabled='disabled';
			}
		}

		var managerPath = "";

		

		hideL = window.setTimeout("hideLoader()", 1500);

		// add the 'unsaved changes' warning event handler
		if( window.addEventListener ) {
			window.addEventListener('beforeunload',checkDirt,false);
		} else if ( window.attachEvent ) {
			window.attachEvent('onbeforeunload',checkDirt);
		} else {
			window.onbeforeunload = checkDirt;
		}
		/* ]]> */
	</script>
	<script type="text/javascript">
		function hideLoader() {
			(function( $ ) {
				$(document).ready(function () {
					setTimeout(
						function () {
							$("#preLoader").fadeOut(300,function () {
								$(this).remove();
							})
						},300
					);
				})
			})( jQuery );
			//document.getElementById('preLoader').style.display = "none";
		}
	</script>
</head>
<body ondragstart="return false"<?php echo $modx_textdir ? ' class="rtl"':''?>>

<div id="preLoader"><div class="preLoaderText"><?php echo $_style['ajax_loader']; ?></div></div>
