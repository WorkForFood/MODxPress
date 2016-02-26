	// TREE FUNCTIONS - FRAME
	// These functions affect the tree frame and any items that may be pointing to the tree.
	var currentFrameState = 'open';
	var defaultFrameWidth = window.globalVars.defaultFrameWidth;
	var userDefinedFrameWidth = window.globalVars.userDefinedFrameWidth;

	var workText;
	var buildText;

	// Create the AJAX mail update object before requesting it
	var updateMailerAjx = new Ajax('index.php', {method:'post', postBody:'updateMsgCount=true', onComplete:showResponse});
	function updateMail(now) {
		try {
			// if 'now' is set, runs immediate ajax request (avoids problem on initial loading where periodical waits for time period before making first request)
			if (now)
				updateMailerAjx.request();
			return false;
		} catch(oException) {
			// Delay first run until we're ready...
			xx=updateMail.delay(1000 * 60,'',true);
		}
	}

	function showResponse(request) {
		console.log(request);
		var counts = request.split(',');
		var elm = $('msgCounter');
		if (elm) elm.innerHTML = counts[0];
		var elm = $('newMail');
		if (elm) elm.style.display = counts[0] >0 ? 'inline' :  'none';
	}

	window.addEvent('load', function() {
		updateMail(true); // First run update
		updateMail.periodical(window.globalVars.updateMail_periodical, '', true); // Periodical Updater
		if(top.__hideTree) {
			// display toc icon
			var elm = $('tocText');
			if(elm) elm.innerHTML = "<a href='#' onclick='defaultTreeFrame();'>"+window.globalVars.updateMail_image+"</a>";
		}
	});


	function setTreeFrameWidth(pos) {
		parent.document.getElementById('tree').style.width    = pos + 'px';
		parent.document.getElementById('resizer').style.left = pos + 'px';
		parent.document.getElementById('main').style.left    = pos + 'px';

	}

	function toggleTreeFrame() {
		var pos = parseInt(parent.document.getElementById('tree').style.width) != 0?0:250;
		setTreeFrameWidth(pos);
	}


	function hideTreeFrame() {
		var pos = 0;
		setTreeFrameWidth(pos);
	}

	function defaultTreeFrame() {
		var pos = 250;
		setTreeFrameWidth(pos);
	}


	//toggle TopMenu Frame
	function setMenuFrameHeight(pos) {
		parent.document.getElementById('tree').style.top    = pos + 'px';
		parent.document.getElementById('resizer').style.top = pos + 'px';
		parent.document.getElementById('resizer2').style.top = pos + 'px';
		parent.document.getElementById('main').style.top    = pos + 'px';
		parent.document.getElementById('mainMenu').style.height    = pos + 'px';
	}

	function toggleMenuFrame() {
		var pos = parseInt(parent.document.getElementById('mainMenu').style.height) != 5?5:85;
		setMenuFrameHeight(pos);
	}


	function hideMenuFrame() {
		var pos = 5;
		setMenuFrameHeight(pos);
	}

	function defaultMenuFrame() {
		var pos = 85;
		setMenuFrameHeight(pos);
	}



	// TREE FUNCTIONS - Expand/ Collapse
	// These functions affect the expanded/collapsed state of the tree and any items that may be pointing to it
	function expandTree() {
		try {
			parent.tree.d.openAll();  // dtree
		} catch(oException) {
			zz=window.setTimeout('expandTree()', 1000);
		}
	}

	function collapseTree() {
		try {
			parent.tree.d.closeAll();  // dtree
		} catch(oException) {
			yy=window.setTimeout('collapseTree()', 1000);
		}
	}

	// GENERAL FUNCTIONS - Refresh
	// These functions are used for refreshing the tree or menu

	function reloadtree() {
		var elm = $('buildText');
		if (elm) {
			elm.innerHTML = window.globalVars.reloadTreeInner;
			elm.style.display = 'block';
		}
		top.tree.saveFolderState(); // save folder state
		setTimeout('top.tree.restoreTree()',200);
		setTimeout('top.restoreTree()',200);
	}

	function reloadmenu() {
		var elm = $('buildText');
		if (elm) {
			elm.innerHTML = window.globalVars.reloadMenuInner;
			elm.style.display = 'block';
		}
		parent.mainMenu.location.reload();
	}

	function startrefresh(rFrame){
		if(rFrame==1){
			x=window.setTimeout('reloadtree()',500);
		}
		if(rFrame==2) {
			x=window.setTimeout('reloadmenu()',500);
		}
		if(rFrame==9) {
			x=window.setTimeout('reloadmenu()',500);
			y=window.setTimeout('reloadtree()',500);
		}
		if(rFrame==10) {
			window.top.location.href = "../"+window.globalVars.startrefresh_10;
		}
	}

	// GENERAL FUNCTIONS - Work
	// These functions are used for showing the user the system is working
	function work() {
		top.tree.ca = "open";
		top.ca = "open";
		var elm = $('workText');
		if (elm) elm.innerHTML = window.globalVars.workInner;
		else w=window.setTimeout('work()', 50);
	}

	function stopWork() {
		var elm = $('workText');
		if (elm) elm.innerHTML = "";
		else  ww=window.setTimeout('stopWork()', 50);
	}

	function showWin() {
		window.open('../');
	}

	function stopIt() {
		top.mainMenu.stopWork();
	}

	function openCredits() {
		parent.main.document.location.href = "index.php?a=18";
		xwwd = window.setTimeout('stopIt()', 2000);
	}

	function NavToggle(element) {
		// This gives the active tab its look
		var navid = document.getElementById('nav');
		var navs = navid.getElementsByTagName('li');
		var navsCount = navs.length;
		for(j = 0; j < navsCount; j++) {
			active = (navs[j].id == element.parentNode.id) ? "active" : "";
			navs[j].className = active;
		}

		// remove focus from top nav
		if(element) element.blur();
	}