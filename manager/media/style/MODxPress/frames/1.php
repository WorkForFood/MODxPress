<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");
header("X-XSS-Protection: 0");
$_SESSION['browser'] = (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 1')!==false) ? 'legacy_IE' : 'modern';
$mxla = $modx_lang_attribute ? $modx_lang_attribute : 'en';
if(!isset($modx->config['manager_menu_height'])) $modx->config['manager_menu_height'] = '70';
if(!isset($modx->config['manager_tree_width']))  $modx->config['manager_tree_width']  = '260';
$modx->invokeEvent('OnManagerPreFrameLoader',array('action'=>$action));
$modx_textdir = isset($modx_textdir) ? $modx_textdir : null;
	function constructLink($action, $img, $text, $allowed) {
		if($allowed==1) { ?>
			<div class="menuLink" onclick="menuHandler(<?php echo $action ; ?>); hideMenu();">
		<?php } else { ?>
			<div class="menuLinkDisabled">
		<?php } ?>
				<span class="contextIcon fa <?php echo $img; ?>"></span><?php echo $text; ?>
			</div>
		<?php
	}
?>
<!DOCTYPE html>
<html <?php echo (isset($modx_textdir) && $modx_textdir ? 'dir="rtl" lang="' : 'lang="').$mxla.'" xml:lang="'.$mxla.'"'; ?>>
<head>
	<script type="text/javascript">
		window.globalVars = {
			"somevar": "someval",
			"unable_set_parent": '<?php echo $_lang['unable_set_parent']; ?>',
			"tree_page_click": '<?php echo (!empty($modx->config['tree_page_click']) ? $modx->config['tree_page_click'] : '27'); ?>',
			"openedArray": {},
			"popupXOffset": <?php echo $modx_textdir ? -190 : 0; ?>,
			"toggleNodeLoadText": "<?php echo $_lang['loading_doc_tree'];?>",
			"tree_plusnode": '<?php echo $_style["tree_plusnode"]?>',
			"tree_minusnode": '<?php echo $_style["tree_minusnode"]; ?>',
			"tree_folderopen": '<?php echo $_style["tree_folderopen"]; ?>',
			"tree_folderopen_secure": '<?php echo $_style["tree_folderopen_secure"]; ?>',
			"tree_folder": '<?php echo $_style["tree_folder"]; ?>',
			"tree_folder_secure": '<?php echo $_style["tree_folder_secure"]; ?>',
			"emptyTrash": "<?php echo $_lang['confirm_empty_trash']; ?>",
			"treeActionAlert": '<?php echo $_lang["unable_set_parent"]; ?>',
			"treeActionHref": "<?php echo (!empty($modx->config['tree_page_click']) ? $modx->config['tree_page_click'] : '27'); ?>",
			"treeActionAlertParent": '<?php echo $_lang["unable_set_parent"]; ?>',
			"treeActionAlertLink": '<?php echo $_lang["unable_set_link"]; ?>',
			"showBinFullTitle": '<?php echo $_lang["empty_recycle_bin"]; ?>',
			"showBinFullInnerHtml": '<?php echo $_style["empty_recycle_bin"]; ?>',
			"showBinEmptyTitle": '<?php echo $_lang["empty_recycle_bin_empty"]; ?>',
			"showBinEmptyInnerHtml": '<?php echo $_style["empty_recycle_bin_empty"]; ?>',
			"removeLock": "<?php echo $_lang['confirm_remove_locks']?>",
			"menuHandler_case_4": "<?php echo $_lang['confirm_delete_resource']; ?>",
			"menuHandler_case_4_else": "<?php echo $_lang['already_deleted']; ?>",
			"menuHandler_case_7": "<?php echo $_lang['confirm_resource_duplicate'] ?>",
			"menuHandler_case_8": "<?php echo $_lang['not_deleted']; ?>",
			"menuHandler_case_8_else": "<?php echo $_lang['confirm_undelete']; ?>",
			"menuHandler_case_9": "<?php echo $_lang['confirm_publish']; ?>",
			"menuHandler_case_10": "<?php echo $_lang['confirm_unpublish']; ?>",
			"menuHandler_case_10_if": "<?php echo $modx->config['site_start']?>"
		};
	</script>
	<title><?php echo $site_name?> - (MODX CMS Manager)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $modx_manager_charset?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/frames/mainframe.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="media/style/<?php echo $modx->config['manager_theme']; ?>/style.css" />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fontAwesome.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/icoMoon.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fonts.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/frames/tree.css' type='text/css' media='all' />
	<script src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/jquery.js" type="text/javascript" rel='stylesheet' ></script>
	<script src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/commons.js" type="text/javascript"></script>
	<script src="media/script/mootools/mootools.js" type="text/javascript"></script>
	<script src="media/script/mootools/moodx.js" type="text/javascript"></script>
	<script type="text/javascript">
		<?php
			if (isset($_SESSION['openedArray'])) {
					$opened = array_filter(array_map('intval', explode('|', $_SESSION['openedArray'])));
					foreach ($opened as $item) {
						printf("window.globalVars.openedArray[%d] = 1;\n", $item);
					}
			}
		?>
	</script>
	<style type="text/css">
		body { background: #fff !important; }
		#tree, #mainMenu { background: #e5e5e5; }
		#tree { overflow: inherit !important; }
	</style>
</head>
<body onClick="hideMenu(1);">
	<div id="resizer"></div>
	<div id="resizer2">
	<div class="hideTopMenuWrapperItem" onclick="mainMenu.toggleMenuFrame();">
			<a id="hideTopMenu"></a>
		</div>
	</div>
	<!-- <iframe name="mainMenu" src="index.php?a=1&amp;f=menu" scrolling="no" frameborder="0" noresize="noresize" style="position: absolute; left: -90000px; top: -90000px;"></iframe> -->
	<div id="mainMenu">
		<iframe name="mainMenu" src="index.php?a=1&amp;f=menu" scrolling="no" frameborder="0" noresize="noresize" ></iframe>
	</div>

	<div id="tree">
		<iframe name="tree" src="index.php?a=1&amp;f=tree" scrolling="no" frameborder="0" onresize="mainMenu.resizeTree();" style="position: absolute; left: -90000px; top: -90000px;"></iframe>
		<?php
	//print_r($_lang);
	// invoke OnTreePrerender event
	$evtOut = $modx->invokeEvent('OnManagerTreeInit',$_REQUEST);
	if (is_array($evtOut))
		echo implode("\n", $evtOut);
?>
<div class="allframewrapper" onClick="hideMenu();">
	<div class="menuframebody" onClick="hideMenu();">

		<div class="menuframebodywrapper active nomobile">
			<div class="menuframebodyactivator active"> <a href="index.php?a=2" alt="<?php echo $site_name; ?>" target="main" onclick="this.blur();"><div class='sidemenuText'><span class='fa fa-diamond sidemenuIcon'></span><?php echo $_lang['home']; ?></div> </a> </div>
		</div>
		<div class="menuframebodywrapper">
			<div class="menuframebodyactivator"><div class='sidemenuText'><span class='fa fa-sitemap sidemenuIcon'></span><?php echo $_lang['export_site.static.php3']; ?></div></div>
			<div class="menuframebodycontainer collapsed">
				<div id="treeSplitter"></div>
					<table id="treeMenu" width="100%"  border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
								<td><a href="#" class="treeButton" id="Button1" onClick="expandTree();" title="<?php echo $_lang['expand_tree']; ?>"><?php echo $_style['expand_tree']; ?></a></td>
								<td><a href="#" class="treeButton" id="Button2" onClick="collapseTree();" title="<?php echo $_lang['collapse_tree']; ?>"><?php echo $_style['collapse_tree']; ?></a></td>
								<?php if ($modx->hasPermission('new_document')) { ?>
									<td><a href="#" class="treeButton" id="Button3a" onClick="top.main.document.location.href='index.php?a=4';" title="<?php echo $_lang['add_resource']; ?>"><?php echo $_style['add_doc_tree']; ?></a></td>
									<td><a href="#" class="treeButton" id="Button3c" onClick="top.main.document.location.href='index.php?a=72';" title="<?php echo $_lang['add_weblink']; ?>"><?php echo $_style['add_weblink_tree']; ?></a></td>
								<?php } ?>
								<td><a href="#" class="treeButton" id="Button4" onClick="top.mainMenu.reloadtree();" title="<?php echo $_lang['refresh_tree']; ?>"><?php echo $_style['refresh_tree']; ?></a></td>
								<td><a href="#" class="treeButton" id="Button5" onClick="showSorter();" title="<?php echo $_lang['sort_tree']; ?>"><?php echo $_style['sort_tree']; ?></a></td>
								<?php if ($modx->hasPermission('empty_trash')) { ?>
									<td><a href="#" id="Button10" class="treeButtonDisabled" title="<?php echo $_lang['empty_recycle_bin_empty'] ; ?>"><?php echo $_style['empty_recycle_bin_empty'] ; ?></a></td>
								<?php } ?>
								 <td><a href="#" class="treeButton" title="<?php echo $_lang['element_management'] ; ?>" onclick="window.open('index.php?a=76','gener','width=800,height=600,top='+((screen.height-600)/2)+',left='+((screen.width-800)/2)+',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')"><?php echo $_style['elements_manage_button']; ?></a></td>
								</tr>
							</table>
						</td>
					  </tr>
					</table>

					<div id="floater">
						<?php
						if(isset($_REQUEST['tree_sortby'])) {
							$_SESSION['tree_sortby'] = $_REQUEST['tree_sortby'];
						}
						if(isset($_REQUEST['tree_sortdir'])) {
							$_SESSION['tree_sortdir'] = $_REQUEST['tree_sortdir'];
						}
						?>
						<form name="sortFrm" id="sortFrm" action="menu.php">
							<table width="100%"  border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding-left: 10px;padding-top: 1px;" colspan="2">
										<select name="sortby">
											<option value="isfolder" <?php echo $_SESSION['tree_sortby']=='isfolder' ? "selected='selected'" : "" ?>><?php echo $_lang['folder']; ?></option>
											<option value="pagetitle" <?php echo $_SESSION['tree_sortby']=='pagetitle' ? "selected='selected'" : "" ?>><?php echo $_lang['pagetitle']; ?></option>
											<option value="id" <?php echo $_SESSION['tree_sortby']=='id' ? "selected='selected'" : "" ?>><?php echo $_lang['id']; ?></option>
											<option value="menuindex" <?php echo $_SESSION['tree_sortby']=='menuindex' ? "selected='selected'" : "" ?>><?php echo $_lang['resource_opt_menu_index'] ?></option>
											<option value="createdon" <?php echo $_SESSION['tree_sortby']=='createdon' ? "selected='selected'" : "" ?>><?php echo $_lang['createdon']; ?></option>
											<option value="editedon" <?php echo $_SESSION['tree_sortby']=='editedon' ? "selected='selected'" : "" ?>><?php echo $_lang['editedon']; ?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td width="99%" style="padding-left: 10px;padding-top: 1px;">
										<select name="sortdir">
											<option value="DESC" <?php echo $_SESSION['tree_sortdir']=='DESC' ? "selected='selected'" : "" ?>><?php echo $_lang['sort_desc']; ?></option>
											<option value="ASC" <?php echo $_SESSION['tree_sortdir']=='ASC' ? "selected='selected'" : "" ?>><?php echo $_lang['sort_asc']; ?></option>
										</select>
										<input type='hidden' name='dt' value='<?php echo htmlspecialchars($_REQUEST['dt']); ?>' />
									</td>
								</tr>
								<tr>
									<td width="1%"><a href="#" class="treeButton" id="button7" style="text-align:right" onClick="updateTree();showSorter();" title="<?php echo $_lang['sort_tree']; ?>"><?php echo $_lang['sort_tree']; ?></a></td>
								</tr>
							</table>
						</form>
					</div>

					<div id="treeHolder">
					<?php
						// invoke OnTreeRender event
						$evtOut = $modx->invokeEvent('OnManagerTreePrerender', $modx->db->escape($_REQUEST));
						if (is_array($evtOut))
							echo implode("\n", $evtOut);
					?>
					<div class="siteRootFolder">
						<?php echo $_style['tree_showtree']; ?>
						<div class="rootNode" onClick="treeAction(0, '<?php echo addslashes($site_name); ?>');"><b><?php echo $site_name; ?></b></div>
						<div class="treeNodeId">[ 0 ]</div>
					</div>
					<div>
						<div id="treeRoot">
							
						</div>
					</div>
					<?php
						// invoke OnTreeRender event
						$evtOut = $modx->invokeEvent('OnManagerTreeRender', $modx->db->escape($_REQUEST));
						if (is_array($evtOut))
							echo implode("\n", $evtOut);
					?>
					</div>

					<div id="mx_contextmenu" onselectstart="return false;">
						<div id="nameHolder">&nbsp;</div>
						<?php
						constructLink(3, $_style["icons_new_document"], $_lang["create_resource_here"], $modx->hasPermission('new_document')); // new Resource
						constructLink(2, $_style["icons_save"], $_lang["edit_resource"], $modx->hasPermission('edit_document')); // edit
						constructLink(5, $_style["icons_move_document"] , $_lang["move_resource"], $modx->hasPermission('save_document')); // move
						constructLink(7, $_style["icons_resource_duplicate"], $_lang["resource_duplicate"], $modx->hasPermission('new_document')); // duplicate
						?>
						<div class="seperator"></div>
						<?php
						constructLink(9, $_style["icons_publish_document"], $_lang["publish_resource"], $modx->hasPermission('publish_document')); // publish
						constructLink(10, $_style["icons_unpublish_resource"], $_lang["unpublish_resource"], $modx->hasPermission('publish_document')); // unpublish
						constructLink(4, $_style["icons_delete"], $_lang["delete_resource"], $modx->hasPermission('delete_document')); // delete
						constructLink(8, $_style["icons_undelete_resource"], $_lang["undelete_resource"], $modx->hasPermission('delete_document')); // undelete
						?>
						<div class="seperator"></div>
						<?php
						constructLink(6, $_style["icons_weblink"], $_lang["create_weblink_here"], $modx->hasPermission('new_document')); // new Weblink
						?>
						<div class="seperator"></div>
						<?php
						constructLink(1, $_style["icons_resource_overview"], $_lang["resource_overview"], $modx->hasPermission('view_document')); // view
						constructLink(12, $_style["icons_preview_resource"], $_lang["preview_resource"], 1); // preview
						?>
					</div>
			</div>
		</div>
		<?php include(MODX_MANAGER_PATH.'media/style/'.$manager_theme.'/includes/mainmenu.inc.php'); ?></div>
	</div>
	</div>

	<div id="main">
		<iframe name="main" id="mainframe" src="index.php?a=2" scrolling="auto" frameborder="0" onload="if (mainMenu.stopWork()) mainMenu.stopWork(); scrollWork();"></iframe>
	</div>

	<?php
	$modx->invokeEvent('OnManagerFrameLoader',array('action'=>$action));
	?>

	<script src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/frames/mainframe.js" type="text/javascript"></script>
	<script src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/frames/tree.js" type="text/javascript"></script>
</body>
</html>