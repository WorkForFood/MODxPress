<?php
/**
 * Filename:       media/style/$modx->config['manager_theme']/style.php
 * Function:       Manager style variables for images and icons.
 * Encoding:       UTF-8
 * Credit:         icons by Mark James of FamFamFam http://www.famfamfam.com/lab/icons/
 * Date:           18-Mar-2010
 * Version:        1.1
 * MODX version:   1.0.3
*/
$style_path = 'media/style/' . $modx->config['manager_theme'] . '/images/';

// Tree Menu Toolbar
$_style['add_doc_tree']             = '<div class="filetreeicon fa fa-file-text-o"></div>';
$_style['add_weblink_tree']         = '<div class="filetreeicon fa fa-anchor"></div>';
$_style['collapse_tree']            = '<div class="filetreeicon fa fa-chevron-up"></div>';
$_style['empty_recycle_bin']        = '<div class="filetreeicon fa fa-trash"></div>';
$_style['empty_recycle_bin_empty']  = '<div class="filetreeicon fa fa-trash-o"></div>';
$_style['expand_tree']              = '<div class="filetreeicon fa fa-chevron-down"></div>';
$_style['hide_tree']                = '<div class="filetreeicon fa fa-chevron-up"></div>';
$_style['refresh_tree']             = '<div class="filetreeicon fa fa-refresh"></div>';
$_style['sort_tree']                = '<div class="filetreeicon fa fa-random"></div>';
$_style['elements_manage_button']   = '<div class="filetreeicon fa fa-cube"></div>';
$_style['show_tree']                = $style_path.'icons/application_side_expand.png';


// Tree Icons
$_style['tree_showtree']            = '<div class="siteRootFolderIcon fa fa-home"></div>';
$_style['tree_minusnode']           = 'fa-minus';
$_style['tree_plusnode']            = 'fa-plus';
$_style['tree_deletedpage']         = 'i-file-remove-2';
$_style['tree_folderclose']         = 'i-folder'; /* folder.png */
$_style['tree_folder']              = 'i-folder'; /* folder.png */
$_style['tree_folderopen']          = 'i-folder-open-2'; /* folder-open.png */
$_style['tree_folder_secure']       = 'i-folder-minus';
$_style['tree_folderopen_secure']   = 'i-folder-minus';
$_style['tree_globe']               = 'i-file-8';
$_style['tree_linkgo']              = 'i-file-8';
$_style['tree_page']                = 'i-file-8';
$_style['tree_page_home']           = 'i-file-8';
$_style['tree_page_404']            = 'i-file-8';/*ok*/
$_style['tree_page_hourglass']      = 'i-file-8';
$_style['tree_page_info']           = 'i-file-8';
$_style['tree_page_blank']          = 'i-file-8';
$_style['tree_page_css']            = 'i-file-8';/*ok*/
$_style['tree_page_html']           = 'i-file-8';
$_style['tree_page_xml']            = 'i-file-8';/*ok*/
$_style['tree_page_js']             = 'i-file-8';/*ok*/
$_style['tree_page_rss']            = 'i-file-8';/*ok*/
$_style['tree_page_pdf']            = 'i-file-8';/*ok*/
$_style['tree_page_word']           = 'i-file-8';/*ok*/
$_style['tree_page_excel']          = 'i-file-8';/*ok*/
$_style['tree_weblink']             = 'i-file-8';
$_style['tree_page_secure']         = 'i-file-8';
$_style['tree_page_blank_secure']   = 'i-file-8';
$_style['tree_page_css_secure']     = 'i-file-8';
$_style['tree_page_html_secure']    = 'i-file-8';
$_style['tree_page_xml_secure']     = 'i-file-8';
$_style['tree_page_js_secure']      = 'i-file-8';
$_style['tree_page_rss_secure']     = 'i-file-8';
$_style['tree_page_pdf_secure']     = 'i-file-8';
$_style['tree_page_word_secure']    = 'i-file-8';
$_style['tree_page_excel_secure']   = 'i-file-8';


// Icons
$_style['icons_stop']                = 'fa fa-ban'; /* folder.png */
$_style['icons_unzip']               = 'fa fa-archive-o'; /* folder.png */
$_style['icons_show']                = 'fa fa-binoculars'; /* folder.png */
$_style['icons_folder']              = 'fa fa-folder'; /* folder.png */
$_style['icons_page']                = 'im i-file-8';
$_style['icons_page_home']           = 'im i-file-8';
$_style['icons_page_404']            = 'im i-file-8';/*ok*/
$_style['icons_page_hourglass']      = 'im i-file-8';
$_style['icons_page_info']           = 'im i-file-8';
$_style['icons_page_blank']          = 'im i-file-8';
$_style['icons_page_css']            = 'im i-file-8';/*ok*/
$_style['icons_page_html']           = 'im i-file-8';
$_style['icons_page_php']            = 'im i-file-8';
$_style['icons_page_xml']            = 'im i-file-8';/*ok*/
$_style['icons_page_js']             = 'im i-file-8';/*ok*/
$_style['icons_page_rss']            = 'im i-file-8';/*ok*/
$_style['icons_page_pdf']            = 'im i-file-8';/*ok*/
$_style['icons_page_word']           = 'im i-file-8';/*ok*/
$_style['icons_page_excel']          = 'im i-file-8';/*ok*/
$_style['icons_add']                = 'fa fa-plus';
$_style['icons_cal']                = $style_path.'icons/cal.gif';
$_style['icons_cal_nodate']         = 'fa fa-times';
$_style['icons_cancel']             = 'fa fa-times';
$_style['icons_close']              = 'fa fa-times';
$_style['icons_delete']             = 'fa fa-trash';
$_style['icons_delete_document']    = 'fa fa-trash';
$_style['icons_delete_folder']      = 'fa fa-trash';
$_style['icons_resource_overview']  = 'fa fa-info';
$_style['icons_resource_duplicate'] = 'fa fa-clone';
$_style['icons_edit_document']      = 'fa fa-pencil';
$_style['icons_email']              = $style_path.'icons/email.png';
$_style['icons_folder']             = 'im i-folder';
$_style['icons_home']               = $style_path.'icons/home.gif';
$_style['icons_information']        = $style_path.'icons/information.png';
$_style['icons_loading_doc_tree']   = $style_path.'icons/information.png'; // top bar
$_style['icons_mail']               = $style_path.'icons/email.png'; // top bar
$_style['icons_message_forward']    = 'fa fa-share';
$_style['icons_message_reply']      = 'fa fa-reply';
$_style['icons_modules']            = $style_path.'icons/modules.gif';
$_style['icons_move_document']      = 'fa fa-arrows';
$_style['icons_new_document']       = 'fa fa-files-o';
$_style['icons_new_weblink']        = 'fa fa-link';
$_style['icons_preview_resource']   = 'fa fa-eye';
$_style['icons_publish_document']   = 'fa fa-reply';
$_style['icons_refresh']            = 'fa fa-refresh'; 
$_style['icons_save']               = 'fa fa-check';
$_style['icons_set_parent']         = 'im i-home-6';
$_style['icons_table']              = 'fa fa-list'; 
$_style['icons_undelete_resource']  = 'fa fa-arrow-up';
$_style['icons_unpublish_resource'] = 'fa fa-ban';
$_style['icons_user']               = 'fa fa-user';
$_style['icons_weblink']            = 'fa fa-link';
$_style['icons_working']            = $style_path.'icons/exclamation.png'; // top bar
$_style['icons_event1']             = $style_path.'icons/event1.png';
$_style['icons_event2']             = $style_path.'icons/event2.png';
$_style['icons_event3']             = $style_path.'icons/event3.png';
$_style['icons_secured']            = $style_path.'icons/secured.gif';

// Tabs
$_style['icons_tab_preview']        = $style_path.'icons/preview.png';

// Indicators
$_style['icons_tooltip']             = 'fa fa-question'; /* folder.png */
$_style['icons_tooltip_over']       = $style_path.'icons/b02_trans.gif';

// Large Icons
$_style['icons_backup_large']       = $style_path.'icons/backup.gif';
$_style['icons_mail_large']         = $style_path.'icons/mail_generic.gif';
$_style['icons_modules_large']      = $style_path.'icons/modules.gif';
$_style['icons_resources_large']    = $style_path.'icons/resources.gif';
$_style['icons_security_large']     = $style_path.'icons/security.gif';
$_style['icons_webusers_large']     = $style_path.'icons/web_users.gif';

// Miscellaneous
$_style['ajax_loader']              = '<div class="loadertext">'.$_lang['loading_page'].'</div><div class="loaderimg"><!--<img src="'.$style_path.'misc/ajax-loader.gif" alt="Please wait" />--></div>';
$_style['tx']                       = $style_path.'misc/_tx_.gif';
$_style['icons_right_arrow']        = $style_path.'icons/circlerightarrow.gif';
$_style['fade']                     = $style_path.'misc/fade.gif';
$_style['ed_save']                  = 'fa fa-save';
$_style['tx']						= '';

?>