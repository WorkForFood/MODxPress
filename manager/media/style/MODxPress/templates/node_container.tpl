<div id="node[+ph.id+]" p="[+ph.parent+]" style="white-space: nowrap;">
	<!--[+ph.spacer+]-->
	<div class="treeItem">
		<div class="treeNodeCollapse fa [+ph.tree_minusnode+]" id="s[+ph.id+]" onclick="toggleNode(this,[+ph.indentplus+],[+ph.id+],[+ph.expandAll+],[+ph.privatewebmgr+]); return false;" oncontextmenu="this.onclick(event); return false;"></div>
		<div class="treeNodeContext im [+tree_folderopen+]" id="f[+ph.id+]" align="absmiddle" title="[+click_to_context+]" onclick="showPopup([+ph.id+],'[+ph.nodetitle+]',event);return false;" oncontextmenu="this.onclick(event);return false;" onmouseover="setCNS(this, 1)" onmouseout="setCNS(this, 0)" onmousedown="itemToChange=[+ph.id+]; selectedObjectName='[+ph.nodetitle+]'; selectedObjectDeleted=[+ph.deleted+]; selectedObjectUrl='[+ph.url+]';" /></div>
		<div class="treeItem_name" onclick="treeAction([+ph.id+], '[+ph.nodetitle+]'); setSelected(this);" onmousedown="itemToChange=[+ph.id+]; selectedObjectName='[+ph.nodetitle+]'; selectedObjectDeleted=[+ph.deleted+]; selectedObjectUrl='[+ph.url+]';" oncontextmenu="document.getElementById('f[+ph.id+]').onclick(event);return false;" title="[+ph.alt+]">[+ph.nodetitleDisplay+] [+ph.weblinkDisplay+] [+ph.pageIdDisplay+]</div>
	</div>
	<div id="rpcNode_[+ph.id+]" class="rpcNode_wrapper" style="display:[+ph.display+]">
	[+ph.childnodes+]
	</div>
</div>