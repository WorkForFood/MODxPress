<?php
if(IN_MANAGER_MODE!="true") die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");
if (!array_key_exists('mail_check_timeperiod', $modx->config) || !is_numeric($modx->config['mail_check_timeperiod'])) {
	$modx->config['mail_check_timeperiod'] = 5;
}
$modx_textdir = isset($modx_textdir) ? $modx_textdir : null;
$mxla = $modx_lang_attribute ? $modx_lang_attribute : 'en';
$uid = $modx->getLoginUserID();
$userdata = $modx->getUserInfo($uid);
$welcome = "Здравствуйте, ";
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
$gravatar = !empty($userdata['photo']) ? "/".$userdata['photo'] : get_gravatar($userdata['email']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html <?php echo ($modx_textdir ? 'dir="rtl" lang="' : 'lang="').$mxla.'" xml:lang="'.$mxla.'"'; ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $modx_manager_charset?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>nav</title>
	<link rel="stylesheet" type="text/css" href="media/style/<?php echo $modx->config['manager_theme']; ?>/style.css" />
	<script src="media/script/mootools/mootools.js" type="text/javascript"></script>
	<script src="media/script/mootools/moodx.js" type="text/javascript"></script>
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fontAwesome.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/fonts.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/<?php echo $modx->config['manager_theme']; ?>/styles/frames/menu.css' type='text/css' media='all' />
	<script type="text/javascript" src="media/script/session.js"></script>
	<script type="text/javascript">
		window.globalVars = {
			"defaultFrameWidth": '<?php echo !$modx_textdir ? '260,*' : '*,260'?>',
			"userDefinedFrameWidth": '<?php echo !$modx_textdir ? '260,*' : '*,260'?>',
			"updateMail_periodical": <?php echo $modx->config['mail_check_timeperiod'] * 1000 ?>,
			"updateMail_image": "<img src='<?php echo $_style['show_tree']?>' alt='<?php echo $_lang['show_tree']?>' width='16' height='16' />",
			"reloadTreeInner": "<?php echo $_lang['loading_doc_tree']?>",
			"reloadMenuInner": "<?php echo $_lang['loading_menu']?>",
			"startrefresh_10": "<?php echo MGR_DIR;?>",
			"workInner": "<?php echo $_lang['working']?>"
		};
	</script>
	<!--[if lt IE 7]>
	<style type="text/css">
	body { behavior: url(media/script/forIE/htcmime.php?file=csshover.htc) }
	img { behavior: url(media/script/forIE/htcmime.php?file=pngbehavior.htc); }
	</style>
	<![endif]-->
	
</head>

<body id="topMenu" class="<?php echo $modx_textdir ? 'rtl':'ltr'?>">

	<div id="tocText"<?php echo $modx_textdir ? ' class="tocTextRTL"' : '' ?>></div>
	<div id="topbar">
	<!--
		<div id="topbar-container">
			<div id="statusbar">
				<span id="buildText"></span>
				<span id="workText"></span>
			</div>
		</div>
	-->
		<div id="userinfo">
			<div class="userinfoActivator openSubMenu" href="#aboutuser">
				<span class='nomobile'>
					<?php echo $welcome.$modx->getLoginUserName(); ?>
				</span>
				<span class='ismobile none'>
					<?php echo $modx->getLoginUserName(); ?>
				</span>
				<div class="userinfoActivatorAvatar">
					<img src="<?php echo $gravatar; ?>">
				</div>
			</div>
		</div>

		<div class="submenuContainer">
			<div class="submenuitem" id="aboutmodx">
				<div class="submenuitemoption"><a href="http://rtfm.modx.com/evolution/1.0/getting-started/what-is-modx" target="blank">О ModX</a></div>
				<div class="submenuitemoption"><a href="http://www.modx.com/" target="blank">ModX.com</a></div>
				<div class="submenuitemoption"><a href="http://docs.evolution-cms.com/" target="blank">Документация</a></div>
				<div class="submenuitemoption"><a href="http://saniock.com/modx-evolution/developer/api.html" target="blank">API MODx</a></div>
				<div class="submenuitemoption"><a href="http://forums.modx.com/" target="blank">Комьюнити</a></div>
				<div class="submenuitemoption"><a href="http://modx.im/" target="blank">Поддержка</a></div>
				<div class="submenuitemoption"><a href="http://modx.com.ua/elements/uroki/" target="blank">Уроки по ModX</a></div>
			</div>
			<div class="submenuitem" id="createnew">
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=4'; return false;" title="<?php echo $_lang['add_resource']; ?>"><?php echo $_lang['add_resource']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=72'; return false;" title="<?php echo $_lang['add_weblink']; ?>"><?php echo $_lang['add_weblink']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=19'; return false;" title="<?php echo $_lang['new_template']; ?>"><?php echo $_lang['new_template']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=300'; return false;" title="<?php echo $_lang['new_tmplvars']; ?>"><?php echo $_lang['new_tmplvars']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=77'; return false;" title="<?php echo $_lang['new_htmlsnippet']; ?>"><?php echo $_lang['new_htmlsnippet']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=23'; return false;" title="<?php echo $_lang['new_snippet']; ?>"><?php echo $_lang['new_snippet']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=101'; return false;" title="<?php echo $_lang['new_plugin']; ?>"><?php echo $_lang['new_plugin']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='/manager/media/browser/mcpuk/browse.php?&type=images'; return false;" title="<?php echo $_lang['files_files']; ?>"><?php echo $_lang['files_files']; ?></a></div>
				<div class="submenuitemoption"><a href="#" onClick="top.main.document.location.href='index.php?a=76'; return false;" title="<?php echo $_lang['element_management'] ; ?>"><?php echo $_lang['element_management'] ; ?></a></div>
			</div>
			<div class="submenuitem" id="aboutuser">
				<?php if ($modx->hasPermission('edit_user')) { ?> 
				<div class="submenuitemoption"><a href="index.php?a=12&id=<?php echo $modx->getLoginUserID(); ?>" target="main" title="<?php echo $_lang['click_to_edit_title']; ?>"><?php echo $_lang['click_to_edit_title']." ".$modx->getLoginUserName(); ?></a></div>
				<?php } ?>
				<?php if ($modx->hasPermission('change_password')) { ?> 
				<div class="submenuitemoption">
					<a onclick="this.blur();" href="index.php?a=28" target="main"><?php echo $_lang['change_password']?></a>
				</div>
				<?php } ?>
				<div class="submenuitemoption"><a href="index.php?a=8" target="_top"><?php echo $_lang['logout']?></a></div>
			</div>
		</div>
		<div id="modxinfo">
			<div class="modxinfoitem openSubMenu" href="#aboutmodx">
				<span class="fa fa-modx modxicon"></span>
			</div>
			<div class="modxinfoitem ismobile none">
				<a href="index.php?a=2" alt="MODxPress" target="main" onclick="this.blur();">
					<div class="modxinfoiteminner">
						<span class="fa fa-home subicon"></span>
					</div>
				</a>
			</div>
			<div class="modxinfoitem">
				<a href="/" target="blank" title="<?php echo $_lang['preview']?>" target="main">
					<div class="modxinfoiteminner">
						<span class="fa fa-eye subicon"></span>
						<span class="nomobile"><?php echo $site_name ?></span>
					</div>
				</a>
			</div>
			<div class="modxinfoitem">
				<a href="index.php?a=71" title="<?php echo $_lang['search']?>" target="main">
					<div class="modxinfoiteminner">
						<span class="fa fa-search subicon"></span>
						<span class="nomobile"><?php echo $_lang['search']?></span>
					</div>
				</a>
			</div>
			<!--
			<div class="modxinfoitem">
				<a href="index.php?a=112&id=2" target="main">
					<div class="modxinfoiteminner">
						<span class="fa fa-refresh subicon"></span>
						0
					</div>
				</a>
			</div>
			-->
			<div class="modxinfoitem">
				<a href="index.php?a=10" title="<?php echo $_lang['you_got_mail']?>" target="main">
					<div class="modxinfoiteminner">
						<span class="fa fa-envelope-o subicon"></span>
						<span id="msgCounter"></span>
					</div>
				</a>
			</div>
			<div class="modxinfoitem openSubMenu" href="#createnew">
				<div class="modxinfoiteminner">
					<span class="fa fa-plus-circle subicon"></span>
					<span class="nomobile"><?php echo $_lang['add']?></span>
				</div>
			</div>
			<div class="modxinfoitem" id="modx-container">
				<div class="modxinfoiteminner" id='topbar-container'>
					<div id="statusbar">
						<div id="buildText"></div>
						<div id="workText"></div>
					</div>
				</div>
			</div>
		</div>

		<form name="menuForm" action="l4mnu.php" class="clear" style="display: none;">
			<input type="hidden" name="sessToken" id="sessTokenInput" value="<?php echo md5(session_id());?>" />
			<div id="Navcontainer">
				<div id="divNav">
					<?php include(MODX_MANAGER_PATH.'media/style/'.$manager_theme.'/includes/mainmenu.inc.php'); ?></div>
				</div>
		</form>
	<script type="text/javascript" src="media/style/<?php echo $modx->config['manager_theme']; ?>/scripts/frames/menu.js"></script>
	<div id="menuSplitter"></div>
</body>
</html>
