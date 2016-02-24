
	var _startY = 85;
	var _dragElement;
	var _oldZIndex = 999;
	var _left;
	var mask = document.createElement('div');
	mask.id = 'mask_resizer';
	mask.style.zIndex = _oldZIndex;

	var rpcNode = null;
	var ca = "open";
	var selectedObject = 0;
	var selectedObjectDeleted = 0;
	var selectedObjectName = "";
	var _rc = 0; // added to fix onclick body event from closing ctx menu

	function treeAction(id, name, treedisp_children) {
		if(ca=="move") {
			try {
				parent.main.setMoveValue(id, name);
			} catch(oException) {
				alert(window.globalVars.unable_set_parent);
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
					parent.main.location.href="index.php?a="+window.globalVars.tree_page_click+"&id=" + id; // edit as default action
				}
			}
		}
		if(ca=="parent") {
			try {
				parent.main.setParent(id, name);
			} catch(oException) {
				alert(window.globalVars.unable_set_parent);
			}
		}
		if(ca=="link") {
			try {
				parent.main.setLink(id);
			} catch(oException) {
				alert(window.globalVars.unable_set_parent);
			}
		}
	}

	InitDragDrop();

	function InitDragDrop() {
		document.getElementById('resizer').onmousedown = OnMouseDown;
		document.getElementById('resizer').onmouseup = OnMouseUp
	}

	function OnMouseDown(e) {
		if (e == null) e = window.event;
		_dragElement = e.target != null ? e.target : e.srcElement;
		if ((e.button == 1 && window.event != null || e.button == 0) && _dragElement.id == 'resizer') {
			_oldZIndex = _dragElement.style.zIndex;
			_dragElement.style.zIndex = 10000;
			_dragElement.style.background = '#a4b9cc';
			document.body.appendChild(mask)
			document.onmousemove = OnMouseMove;
			document.body.focus();
			document.onselectstart = function () {
				return false
			};
			_dragElement.ondragstart = function () {
				return false
			};
			return false
		}
	}

	function ExtractNumber(value) {
		var n = parseInt(value);
		return n == null || isNaN(n) ? 0 : n
	}

	function OnMouseMove(e) {
		if (e == null) var e = window.event;
		console.log(screen.width)
		if(e.clientX < 200 || e.clientX >= screen.width/2) { return false; }
		_dragElement.style.left = e.clientX + 'px';
		_dragElement.style.top = _startY + 'px';
		document.getElementById('tree').style.width = e.clientX + 'px';
		document.getElementById('main').style.left = e.clientX + 'px'
	}

	function OnMouseUp(e) {
		if (_dragElement != null) {
			_dragElement.style.zIndex = _oldZIndex;
			_dragElement.style.background = 'transparent';
			_dragElement.ondragstart = null;
			_dragElement = null;
			document.body.removeChild(mask);
			document.onmousemove = null;
			document.onselectstart = null
		}
	}

	//save scrollPosition
	function getQueryVariable(variable, query) {
		var vars = query.split('&');
		for (var i = 0; i < vars.length; i++) {
			var pair = vars[i].split('=');
			if (decodeURIComponent(pair[0]) == variable) {
				return decodeURIComponent(pair[1]);
			}
		}
	}

	function scrollWork() {
		var frm = document.getElementById("mainframe").contentWindow;
		currentPageY = localStorage.getItem('page_y');
		pageUrl = localStorage.getItem('page_url');
		if (currentPageY === undefined) {
			localStorage.setItem('page_y') = 0;
		}
		if (pageUrl === null) {
			pageUrl = frm.location.search.substring(1);
		}
		console.log(pageUrl +' '+ frm.location.search.substring(1));
		if ( getQueryVariable('a', pageUrl) == getQueryVariable('a', frm.location.search.substring(1)) ) {
			if ( getQueryVariable('id', pageUrl) == getQueryVariable('id', frm.location.search.substring(1)) ){
				frm.scrollTo(0,currentPageY);
			}
		}
		frm.onscroll = function(){
			if (frm.pageYOffset > 0) {
				localStorage.setItem('page_y', frm.pageYOffset);
				localStorage.setItem('page_url', frm.location.search.substring(1));
			}
		}        
	}