	window.addEvent('load', function(){
		resizeTree();
		restoreTree();
		window.addEvent('resize', resizeTree);
	});

	var rpcNode = null;
	var ca = "open";
	var selectedObject = 0;
	var selectedObjectDeleted = 0;
	var selectedObjectName = "";
	var _rc = 0; // added to fix onclick body event from closing ctx menu



	// return window dimensions in array
	function getWindowDimension() {
		var width  = 0;
		var height = 0;

		if ( typeof( window.innerWidth ) == 'number' ){
			width  = window.innerWidth;
			height = window.innerHeight;
		}else if ( document.documentElement &&
				 ( document.documentElement.clientWidth ||
				   document.documentElement.clientHeight ) ){
			width  = document.documentElement.clientWidth;
			height = document.documentElement.clientHeight;
		}
		else if ( document.body &&
				( document.body.clientWidth || document.body.clientHeight ) ){
			width  = document.body.clientWidth;
			height = document.body.clientHeight;
		}

		return {'width':width,'height':height};
	}

	function resizeTree() {

	}

	function getScrollY() {
	  var scrOfY = 0;
	  if( typeof( window.pageYOffset ) == 'number' ) {
		//Netscape compliant
		scrOfY = window.pageYOffset;
	  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
		//DOM compliant
		scrOfY = document.body.scrollTop;
	  } else if( document.documentElement &&
		  (document.documentElement.scrollTop ) ) {
		//IE6 standards compliant mode
		scrOfY = document.documentElement.scrollTop;
	  }
	  return scrOfY;
	}

	function showPopup(id,title,e){
		var x, y;
		var mnu = $('mx_contextmenu');
		var bodyHeight = parseInt(document.body.offsetHeight);
		x = e.clientX>0 ? e.clientX:e.pageX;
		y = e.clientY>0 ? e.clientY:e.pageY;
		y = getScrollY()+(y/2);
		if (y+mnu.offsetHeight > bodyHeight) {
			// make sure context menu is within frame
			y = y - ((y+mnu.offsetHeight)-bodyHeight+5);
		}
		itemToChange=id;
		selectedObjectName= title;
		dopopup(x+5,y);
		e.cancelBubble=true;
		return false;
	}

	function dopopup(x,y) {
		if(selectedObjectName.length>20) {
			selectedObjectName = selectedObjectName.substr(0, 20) + "...";
		}
		var h,context = $('mx_contextmenu');
		context.style.left= x+window.globalVars.popupXOffset+"px"; //offset menu to the left if rtl is selected
		context.style.top = y+"px";
		var elm = $("nameHolder");
		elm.innerHTML = selectedObjectName;

		context.style.visibility = 'visible';
		_rc = 1;
		setTimeout("_rc = 0;",100);
	}

	function hideMenu() {
		if (_rc) return false;
		$('mx_contextmenu').style.visibility = 'hidden';
	}

	function toggleNode(node,indent,parent,expandAll,privatenode) {
		privatenode = (!privatenode || privatenode == '0') ?  '0' : '1';
		rpcNode = $(node.parentNode.parentNode.lastChild);
		if(!rpcNode) {
			rpcNode = $(node.parentNode.parentNode.getElementById("rpcNode_"+parent));
		}

		var rpcNodeText;
		var loadText = window.globalVars.toggleNodeLoadText;

		var signImg = document.getElementById("s"+parent);
		var folderImg = document.getElementById("f"+parent);

		if (rpcNode.style.display != 'block') {
			// expand
			if(signImg && signImg.classList.contains(window.globalVars.tree_plusnode)) {
				signImg.classList.remove(window.globalVars.tree_plusnode);
				signImg.classList.add(window.globalVars.tree_minusnode);
				folderImg.classList.remove(window.globalVars.tree_folderopen);
				folderImg.classList.remove(window.globalVars.tree_folderopen_secure);
				var newImg = (privatenode == '0') ? window.globalVars.tree_folderopen : window.globalVars.tree_folderopen_secure;
				folderImg.classList.add(newImg);
			}

			rpcNodeText = rpcNode.innerHTML;

			if (rpcNodeText=="" || rpcNodeText.indexOf(loadText)>0) {
				var i, spacer='';
				for(i=0;i<=indent+1;i++) spacer+='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				rpcNode.style.display = 'block';
				//Jeroen set opened
				window.globalVars.openedArray[parent] = 1 ;
				//Raymond:added getFolderState()
				var folderState = getFolderState();
				rpcNode.innerHTML = "<span class='emptyNode' style='white-space:nowrap;'>"+spacer+"&nbsp;&nbsp;&nbsp;"+loadText+"...<\/span>";
				new Ajax('index.php?a=1&f=nodes&indent='+indent+'&parent='+parent+'&expandAll='+expandAll+folderState, {method: 'get',onComplete:rpcLoadData}).request();
			} else {
				rpcNode.style.display = 'block';
				//Jeroen set opened
				window.globalVars.openedArray[parent] = 1 ;
			}
		}
		else {
			// collapse
			if(signImg && signImg.classList.contains(window.globalVars.tree_minusnode)) {
				signImg.classList.add(window.globalVars.tree_plusnode);
				signImg.classList.remove(window.globalVars.tree_minusnode);
				folderImg.classList.remove(window.globalVars.tree_folder);
				folderImg.classList.remove(window.globalVars.tree_folder_secure);
				var newImg = (privatenode == '0') ? window.globalVars.tree_folder : window.globalVars.tree_folder_secure;
				folderImg.classList.add(newImg);
			}
			//rpcNode.innerHTML = '';
			rpcNode.style.display = 'none';
			window.globalVars.openedArray[parent] = 0 ;
		}
	}

	function rpcLoadData(response) {
		if(rpcNode != null){
			rpcNode.innerHTML = typeof response=='object' ? response.responseText : response ;
			rpcNode.style.display = 'block';
			rpcNode.loaded = true;
			var elm = top.mainMenu.$("buildText");
			if (elm) {
				elm.innerHTML = "";
				elm.style.display = 'none';
			}
			// check if bin is full
			if(rpcNode.id=='treeRoot') {
				var e = $('binFull');
				if(e) showBinFull();
				else showBinEmpty();
			}

			// check if our payload contains the login form :)
			e = $('mx_loginbox');
			if(e) {
				// yep! the seession has timed out
				rpcNode.innerHTML = '';
				top.location = 'index.php';
			}
		}
	}

	function expandTree() {
		rpcNode = $('treeRoot');
		new Ajax('index.php?a=1&f=nodes&indent=1&parent=0&expandAll=1', {method: 'get',onComplete:rpcLoadData}).request();
	}

	function collapseTree() {
		rpcNode = $('treeRoot');
		new Ajax('index.php?a=1&f=nodes&indent=1&parent=0&expandAll=0', {method: 'get',onComplete:rpcLoadData}).request();
	}

	// new function used in body onload
	function restoreTree() {
		rpcNode = $('treeRoot');
		new Ajax('index.php?a=1&f=nodes&indent=1&parent=0&expandAll=2', {method: 'get',onComplete:rpcLoadData}).request();
	}

	function setSelected(elSel) {
		var all = document.getElementById("treeHolder").getElementsByTagName( "DIV" );
		var l = all.length;
		for ( var i = 0; i < l; i++ ) {
			el = all[i];
			if (el.classList.contains("active")) {
				el.classList.remove("active");
			}
		}
		elSel.classList.add("active");
	}

	// set Context Node State
	function setCNS(n, b) {
		if(b==1) {
			n.style.backgroundColor="beige";
		} else {
			n.style.backgroundColor="";
		}
	}

	function updateTree() {
		rpcNode = $('treeRoot');
		treeParams = 'a=1&f=nodes&indent=1&parent=0&expandAll=2&dt=' + document.sortFrm.dt.value + '&tree_sortby=' + document.sortFrm.sortby.value + '&tree_sortdir=' + document.sortFrm.sortdir.value;
		new Ajax('index.php?'+treeParams, {method: 'get',onComplete:rpcLoadData}).request();
	}

	function emptyTrash() {
		if(confirm(window.globalVars.emptyTrash)==true) {
			top.main.document.location.href="index.php?a=64";
		}
	}

	currSorterState="none";
	function showSorter() {
		if(currSorterState=="none") {
			currSorterState="block";
			document.getElementById('floater').style.display=currSorterState;
		} else {
			currSorterState="none";
			document.getElementById('floater').style.display=currSorterState;
		}
	}

	function treeAction(id, name, treedisp_children) {
		if(ca=="move") {
			try {
				parent.main.setMoveValue(id, name);
			} catch(oException) {
				alert(window.globalVars.treeActionAlert);
			}
		}
		if(ca=="open" || ca=="") {
			if(id==0) {
				// do nothing?
				parent.main.location.href="index.php?a=2";
			} else {
				// parent.main.location.href="index.php?a=3&id=" + id + getFolderState(); //just added the getvar &opened=
				if(treedisp_children==0) {
					parent.main.location.href="index.php?a=3&id=" + id + getFolderState();
				} else {
					parent.main.location.href="index.php?a="+window.globalVars.treeActionHref+"&id=" + id; // edit as default action
				}
			}
		}
		if(ca=="parent") {
			try {
				parent.main.setParent(id, name);
			} catch(oException) {
				alert(window.globalVars.treeActionAlertParent);
			}
		}
		if(ca=="link") {
			try {
				parent.main.setLink(id);
			} catch(oException) {
				alert(window.globalVars.treeActionAlertLink);
			}
		}
	}

	//Raymond: added getFolderState,saveFolderState
	function getFolderState(){
		if (window.globalVars.openedArray != [0]) {
				oarray = "&opened=";
				for (key in window.globalVars.openedArray) {
				   if (window.globalVars.openedArray[key] == 1) {
					  oarray += key+"|";
				   }
				}
		} else {
				oarray = "&opened=";
		}
		return oarray;
	}
	function saveFolderState() {
		var folderState = getFolderState();
		new Ajax('index.php?a=1&f=nodes&savestateonly=1'+folderState, {method: 'get'}).request();
	}

	// show state of recycle bin
	function showBinFull() {
		var a = $('Button10');
		var title = window.globalVars.showBinFullTitle;
		if (a) {
			if(!a.setAttribute) a.title = title;
			else a.setAttribute('title',title);
			a.innerHTML = window.globalVars.showBinFullInnerHtml;
			a.className = 'treeButton';
			a.onclick = emptyTrash;
		}
	}

	function showBinEmpty() {
		var a = $('Button10');
		var title = window.globalVars.showBinEmptyTitle;
		if (a) {
			if(!a.setAttribute) a.title = title;
			else a.setAttribute('title',title);
			a.innerHTML = window.globalVars.showBinEmptyInnerHtml;
			a.className = 'treeButtonDisabled';
			a.onclick = '';
		}
	}

	// GENERAL FUNCTIONS - Remove locks
	// This function removes locks on documents, templates, parsers, and snippets
	function removeLocks() {
		if(confirm(window.globalVars.removeLock)==true) {
			top.main.document.location.href="index.php?a=67";
		}
	}

	// Set 'treeNodeSelected' class on document node when editing via Context Menu
	function setActiveFromContextMenu( doc_id ){
		//$$('.treeNodeSelected').removeClass('treeNodeSelected');
		//$$('#node'+doc_id+' span')[0].className='treeNodeSelected';
	}

	// Context menu stuff
	function menuHandler(action) {
		switch (action) {
			case 1 : // view
				setActiveFromContextMenu( itemToChange );
				top.main.document.location.href="index.php?a=3&id=" + itemToChange;
				break;
			case 2 : // edit
				setActiveFromContextMenu( itemToChange );
				top.main.document.location.href="index.php?a=27&id=" + itemToChange;
				break;
			case 3 : // new Resource
				top.main.document.location.href="index.php?a=4&pid=" + itemToChange;
				break;
			case 4 : // delete
				if(selectedObjectDeleted==0) {
					if(confirm("'" + selectedObjectName + "'\n"+window.globalVars.menuHandler_case_4)==true) {
						top.main.document.location.href="index.php?a=6&id=" + itemToChange;
					}
				} else {
					alert("'" + selectedObjectName + "' "+window.globalVars.menuHandler_case_4_else);
				}
				break;
			case 5 : // move
				top.main.document.location.href="index.php?a=51&id=" + itemToChange;
				break;
			case 6 : // new Weblink
				top.main.document.location.href="index.php?a=72&pid=" + itemToChange;
				break;
			case 7 : // duplicate
				if(confirm(window.globalVars.menuHandler_case_7)==true) {
					   top.main.document.location.href="index.php?a=94&id=" + itemToChange;
				   }
				break;
			case 8 : // undelete
				if(selectedObjectDeleted==0) {
					alert("'" + selectedObjectName + "' "+window.globalVars.menuHandler_case_8);
				} else {
					if(confirm("'" + selectedObjectName + "' "+window.globalVars.menuHandler_case_8_else)==true) {
						top.main.document.location.href="index.php?a=63&id=" + itemToChange;
					}
				}
				break;
			case 9 : // publish
				if(confirm("'" + selectedObjectName + "' "+window.globalVars.menuHandler_case_9)==true) {
					top.main.document.location.href="index.php?a=61&id=" + itemToChange;
				}
				break;
			case 10 : // unpublish
				if (itemToChange != window.globalVars.menuHandler_case_10_if) {
					if(confirm("'" + selectedObjectName + "' "+window.globalVars.menuHandler_case_10)==true) {
						top.main.document.location.href="index.php?a=62&id=" + itemToChange;
					}
				} else {
					alert('Document is linked to site_start variable and cannot be unpublished!');
				}
				break;
			case 12 : // preview	
				window.open(selectedObjectUrl,'previeWin'); //re-use 'new' window
				break;

			default :
				alert('Unknown operation command.');
		}
	}