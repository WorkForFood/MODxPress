<div id="node[+ph.id+]" p="[+ph.parent+]" style="white-space: nowrap;"><!--[+ph.spacer+][+ph.pad+]-->
	<div  class="treeItem">
		<div class="treeNodeContext im [+ph.icon+]" id="p[+ph.id+]" title="[+click_to_context+]" onclick="showPopup([+ph.id+],'[+ph.nodetitle+]',event);return false;" oncontextmenu="this.onclick(event);return false;" onmouseover="setCNS(this, 1)" onmouseout="setCNS(this, 0)" onmousedown="itemToChange=[+ph.id+]; selectedObjectName='[+ph.nodetitle+]'; selectedObjectDeleted=[+ph.deleted+]; selectedObjectUrl='[+ph.url+]'"></div>
		<div class="treeItem_name" p="[+ph.parent+]" onclick="treeAction([+ph.id+], '[+ph.nodetitle+]'); setSelected(this);" onmousedown="itemToChange=[+ph.id+]; selectedObjectName='[+ph.nodetitle+]'; selectedObjectDeleted=[+ph.deleted+]; selectedObjectUrl='[+ph.url+]';" oncontextmenu="document.getElementById('p[+ph.id+]').onclick(event);return false;" title="[+ph.alt+]">
			[+ph.nodetitleDisplay+] [+ph.weblinkDisplay+] [+ph.pageIdDisplay+]
		</div>
	</div>
</div>