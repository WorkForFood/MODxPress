jQuery.noConflict();
 
(function( $ ) {
    $(document).ready(function () {

    	var $collapsebutton = null;
    	var $resizer = $("#resizer");
    	var $openSubMenu = null;
    	var $openSubMenuLeft = null;
    	var $treecontents = null;
    	var $maincontents = null;
    	var $mainMenucontents = null;
	    var $openedFrameBody = null;
    	var $document = $(document);
    	var $window = $(window);

    	$(".menuframebody .menuframebodyactivator").click(function () {
    		var iscollapsed = false;
    		if($(this).closest(".menuframebody").hasClass("collapsed")) { iscollapsed = true; }
    		if($(this).hasClass("active")) {
    			if(!$(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").hasClass("collapsed")) {
    				if(!iscollapsed) {
	    				$(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").slideUp(200, function () {
			    			$(this).addClass("collapsed");
			    		});
	    			}
    			} else {
    				if(!iscollapsed) {
	    				$(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").stop().removeClass("collapsed").slideDown(200);
	    			}
    			}
    			return;
    		}
    		$(".menuframebody .menuframebodyactivator").removeClass("active");
    		if(!iscollapsed) {
	    		$(".menuframebody .menuframebodycontainer").slideUp(200, function () {
	    			$(this).addClass("collapsed");
	    		});
	    		$(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").stop().removeClass("collapsed").slideDown(200);
	    	}
    		$(this).addClass("active");
			if($(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").size() == 0) { return; }
    		return false;
    	});

    	$(".menuframebodycontainer .menuframebodywrapper a").click(function () {
    		if($(this).hasClass("active")) { return }
    		$(".menuframebodycontainer .menuframebodywrapper a").removeClass("active");
    		$(this).addClass("active");
    	});

    	$document.find("#collapse").click(function () {
	    	$(document).find(".menuframebody .menuframebodycontainer").slideUp(200, function () {
	    		$(this).addClass("collapsed");
	    	});
	    	if($(this).hasClass("collapsed")) {
	    		if($openedFrameBody) {
		   			$openedFrameBody.removeClass("collapsed");
		   			$openedFrameBody.slideDown(200);
		   		}
	    		$(document).find(".menuframebody").removeClass("collapsed");
	    		$(this).removeClass("collapsed");
	    		$resizer.css("display","block");
	    		var oldwidth = $('#tree').data("oldwidth");
	    		$('#tree').animate({"width":oldwidth+'px'},200);
				$('#main').animate({"left": oldwidth+'px'},200);
	    	} else {
	    		$openedFrameBody = $(document).find(".menuframebodycontainer:not(.collapsed)");
	    		$(document).find(".menuframebody").addClass("collapsed");
	    		$(this).addClass("collapsed");
	    		$resizer.css("display","none");
	    		$('#tree').data("oldwidth",$('#tree').width());
		   		$('#tree').animate({"width": '44px'},200);
				$('#main').animate({"left": '44px'},200);
	    	}
	    	return false;
	    })

		$document.find(".menuframebody").find(".menuframebodyactivator").click(function () {
	    	$openedFrameBody = null;
	    	var $allwrappers = $document.find(".submenuitem_left");
	    	var $wrapper = $("<div class='submenuitem_left nowwrapper'></div>");
	    	$allwrappers.fadeOut(200, function () {
	    		$(this).remove();
	    	})
	    	if(!$(this).closest(".menuframebody").hasClass("collapsed")) { return; }
	    	if($(this).children("a").size() > 0) { return; }
	    	var $contentContainer = $(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").clone();
	    	var thistop = Math.ceil($(this).offset().top);
	    	var thisheight = $(this).outerHeight();
	    	$document.find("body").append($wrapper);
		   	$wrapper.css("top",thistop).fadeIn(200);
		   	$contentContainer.removeAttr("style").removeClass("collapsed");
		   	if($contentContainer.find("#treeHolder").size() > 0) {
		   		$contentContainer = $contentContainer.find("#treeHolder").clone();
		   		$contentContainer.removeAttr("style");
		   		$contentContainer.find("img").remove();
		   	}
		   	$wrapper.append($contentContainer);
		   	$openSubMenuLeft = $(this);
			if($(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").size() == 0) { return; }
		   	return false;
	    })

    	$('#tree iframe').load(function() {
    		$treecontents = $(this).contents();
    		$collapsebutton = $treecontents.find("#collapse");
    		bindOptionsToTree();
    		checkAllContents();
	    });
	    $('#main iframe').load(function() {
    		$maincontents = $(this).contents();
    		bindOptionsToMain();
    		checkAllContents();
	    });
	    $('#mainMenu iframe').load(function() {
    		$mainMenucontents = $(this).contents();
    		$openSubMenu = $mainMenucontents.find(".openSubMenu");
    		bindOptionsToMainMenu();
    		checkAllContents();
	    });
	    bindOptionsToTree = function () {
	    	$collapsebutton.click(function () {
	    		console.log($(this));
	    		$treecontents.find(".menuframebody .menuframebodycontainer").slideUp(200, function () {
	    			$(this).addClass("collapsed");
	    		});
	    		console.log($openedFrameBody);
	    		if($(this).hasClass("collapsed")) {
	    			if($openedFrameBody) {
		    			$openedFrameBody.removeClass("collapsed");
		    			$openedFrameBody.slideDown(200);
		    		}
	    			$treecontents.find(".menuframebody").removeClass("collapsed");
	    			$(this).removeClass("collapsed");
	    			$resizer.css("display","block");
	    			var oldwidth = $('#tree').data("oldwidth");
	    			$('#tree').animate({"width": oldwidth+'px'},200);
					$('#main').animate({"left": oldwidth+'px'},200);
	    		} else {
	    			$openedFrameBody = $treecontents.find(".menuframebodycontainer:not(.collapsed)");
	    			$treecontents.find(".menuframebody").addClass("collapsed");
	    			$(this).addClass("collapsed");
	    			$resizer.css("display","none");
	    			$('#tree').data("oldwidth",$('#tree').width());
		    		$('#tree').animate({"width": '44px'},200);
					$('#main').animate({"left": '44px'},200);
	    		}
	    	})
	    	$treecontents.find(".menuframebody").find(".menuframebodyactivator").click(function () {
	    		$openedFrameBody = null;
	    		var $allwrappers = $document.find(".submenuitem_left");
	    		var $wrapper = $("<div class='submenuitem_left nowwrapper'></div>");
	    		$allwrappers.fadeOut(200, function () {
	    			$(this).remove();
	    		})
	    		if(!$(this).closest(".menuframebody").hasClass("collapsed")) { return; }
	    		if($(this).children("a").size() > 0) { return; }
	    		var $contentContainer = $(this).closest(".menuframebodywrapper").find(".menuframebodycontainer").clone();
	    		var thistop = Math.ceil($(this).offset().top)+32;
	    		var thisheight = $(this).outerHeight();
	    		$document.find("body").append($wrapper);
		    	$wrapper.css("top",thistop).fadeIn(200);
		    	$contentContainer.removeAttr("style");
		    	if($contentContainer.find("#treeHolder").size() > 0) {
		    		$contentContainer = $contentContainer.find("#treeHolder").clone();
		    		$contentContainer.removeAttr("style");
		    		$contentContainer.find("img").remove();
		    	}
		    	$wrapper.append($contentContainer);
		    	$openSubMenuLeft = $(this);
		    	return false;
	    	})
	    }
	    bindOptionsToMain = function () {
	    	$maincontents.find("body").css({"background":"#fff"});
	        $maincontents.find(".dropdownActivatorInsert").on("ontouchend touchend", function () {
	            if(!$(this).hasClass("active")) {
	                $(this).addClass("active");
	                $maincontents.find(".dropdownList").slideDown(200);
	            } else {
	                $(this).removeClass("active");
	                $maincontents.find(".dropdownList").slideUp(200);
	            }
	            return false;
	        })
	        $maincontents.find(".dropdownButton").hover( 
	            function () {
	                $(this).addClass("active");
	                $maincontents.find(".dropdownList").stop().slideDown(200);
	            },
	            function (e) {
	                $(this).removeClass("active");
	                $maincontents.find(".dropdownList").stop().slideUp(200);
	            }
	        )
	        $maincontents.find(".dropdownListItem").click(function () {
	            if($(this).find("input").attr("checked") == "checked") {
	                setTimeout( function () {
	                    $par.trigger("click");
	                },100);
	                return; 
	            }
	            var thistext = $(this).find(".dropdownListItemText").text();
	            var $par = $(this).closest(".dropdownButton");
	            var $insertEl = $par.find(".dropdownActivatorInsert");
	            $insertEl.text(thistext);
	            $par.find("input").removeAttr("checked");
	            $(this).find("input").attr("checked",1);
	            $par.find(".dropdownActivator").removeClass("active");
	            $par.find(".dropdownList").slideUp(200);
	            setTimeout( function () {
	                $par.trigger("click");
	            },100);
	            return false;
	        })
	        $maincontents.find("body").click(function (e) {
	            if($(e.target).closest(".dropdownButton").size() == 0) {
	                $maincontents.find(".dropdownList").slideUp(200);
	                $maincontents.find(".dropdownActivatorInsert").removeClass("active");
	            }
	        });
	    }
	    bindOptionsToMainMenu = function () {
	    	$openSubMenu.bind("click touchstart", function () {
	    		var thisleft = Math.ceil($(this).offset().left);
	    		var thiswidth = $(this).outerWidth();
	    		var $submenu = $mainMenucontents.find(".submenuitem"+$(this).attr("href")).clone();
	    		var $allmenu = $document.find(".submenuitem:not("+$(this).attr("href")+")");
	    		if($(this).hasClass("active")) {
	    			$(this).removeClass("active");
	    			$submenu.fadeOut(200, function () {
	    				$(this).remove();
	    			})
	    			return;
	    		}
	    		$openSubMenu.removeClass("active");
	    		$(this).addClass("active");
		    	$document.find("body").append($submenu);
		    	$submenu.fadeIn(200);
	    		$allmenu.each(function () {
	    			$(this).fadeOut(200, function () {
	    				$(this).remove();
	    			})
	    		});
	    		thisleft = thisleft+$submenu.outerWidth() <= $(window).width() ? thisleft : $(window).width()-(thisleft+thiswidth);
	    		if(Math.ceil(Math.ceil($(this).offset().left))+Math.ceil($submenu.outerWidth()) <= $(window).width()) {
	    			$submenu.css({"left":thisleft,"right":"auto"});
	    		} else {
	    			$submenu.css({"left":"auto","right":thisleft});
	    		}
	    	})
	    	$openSubMenu.hover(
	    		function () {
		    		//alert($(this).attr("href"));
		    	},
		    	function () {
		    		//alert($(this).attr("href"));
		    	}
	    	)
	    }

	    function checkMobileVisibility () {
	    	var screenwidth = $window.width();
	    	var screenheight = $window.height();
	    	if(screenwidth >= 640 && screenheight >= 640) {
		    	$mainMenucontents.find(".nomobile").removeClass("none");
		    	$mainMenucontents.find(".ismobile").addClass("none");
				$treecontents.find(".nomobile, #collapse").removeClass("none");
	    		$treecontents.find(".ismobile").addClass("none");
				$maincontents.find(".nomobile, #collapse").removeClass("none");
	    		$maincontents.find(".ismobile").addClass("none");
				$document.find(".nomobile, #collapse").removeClass("none");
	    		$document.find(".ismobile").addClass("none");

	    		$mainMenucontents.find("body").removeClass("mobile");
	    		$treecontents.find("body").removeClass("mobile");
	    		$maincontents.find("body").removeClass("mobile");
	    		$document.find("body").removeClass("mobile");
		    } else {
				$mainMenucontents.find(".nomobile").addClass("none");
		    	$mainMenucontents.find(".ismobile").removeClass("none");
				$treecontents.find(".nomobile, #collapse").addClass("none");
	    		$treecontents.find(".ismobile").removeClass("none");
				$maincontents.find(".nomobile, #collapse").addClass("none");
	    		$maincontents.find(".ismobile").removeClass("none");
				$document.find(".nomobile, #collapse").addClass("none");
	    		$document.find(".ismobile").removeClass("none");
	    		$mainMenucontents.find("body").addClass("mobile");
	    		$treecontents.find("body").addClass("mobile");
	    		$maincontents.find("body").addClass("mobile");
	    		$document.find("body").addClass("mobile");
		    }
	    }

	    function checkMobile () {
	    	if($collapsebutton.hasClass("collapsed")) {
	    		return true;
	    	}
	    	var screenwidth = $window.width();
	    	var screenheight = $window.height();
	    	if(!$document.find('#tree').data("oldwidth")) {
	    		$document.find('#tree').data("oldwidth",$document.find('#tree').width());
	    	}
	    	$(".submenuitem_left").fadeOut(200,function () {
	    		$(this).remove();
	    	})
	    	if(screenwidth >= 640 && screenheight >= 640) {
	    		if(!$treecontents.find(".menuframebody").hasClass("collapsed")) { return; }
	    		if($openedFrameBody) {
	    			$openedFrameBody.removeClass("collapsed");
	    			$openedFrameBody.slideDown(200);
	    		}
	    		oldwidth = $document.find('#tree').data("oldwidth");
	    		$treecontents.find(".menuframebody").removeClass("collapsed");
	    		$resizer.css("display","block");
	    		$document.find('#tree').animate({"width": oldwidth+'px'},200);
				$document.find('#main').animate({"left": oldwidth+'px'},200);
	    	} else {
	    		oldwidth = $document.find('#tree').data("oldwidth");
	    		if($treecontents.find(".menuframebody").hasClass("collapsed")) { return; }
	    		$treecontents.find(".menuframebody").addClass("collapsed");
	    		$resizer.css("display","none");
	    		$openedFrameBody = $treecontents.find(".menuframebodycontainer:not(.collapsed)");
	    		$treecontents.find(".menuframebodycontainer").slideUp(200,function () {
	    			$(this).addClass("collapsed");
	    		});
		    	$document.find('#tree').animate({"width": '44px'},200);
				$document.find('#main').animate({"left": '44px'},200);
	    	}
	    }

	    function checkMobileMain () {
	    	if($document.find("#collapse").hasClass("collapsed")) {
	    		return true;
	    	}
	    	var screenwidth = $window.width();
	    	var screenheight = $window.height();
	    	if(!$document.find('#tree').data("oldwidth")) {
	    		$document.find('#tree').data("oldwidth",$document.find('#tree').width());
	    	}
	    	$(".submenuitem_left").fadeOut(200,function () {
	    		$(this).remove();
	    	})
	    	if(screenwidth >= 640 && screenheight >= 640) {
	    		if(!$document.find(".menuframebody").hasClass("collapsed")) { return; }
	    		if($openedFrameBody) {
	    			$openedFrameBody.removeClass("collapsed");
	    			$openedFrameBody.slideDown(200);
	    		}
	    		oldwidth = $document.find('#tree').data("oldwidth");
	    		$document.find(".menuframebody").removeClass("collapsed");
	    		$resizer.css("display","block");
	    		$document.find('#tree').animate({"width": oldwidth+'px'},200);
				$document.find('#main').animate({"left": oldwidth+'px'},200);
	    	} else {
	    		oldwidth = $document.find('#tree').data("oldwidth");
	    		if($document.find(".menuframebody").hasClass("collapsed")) { return; }
	    		$document.find(".menuframebody").addClass("collapsed");
	    		$resizer.css("display","none");
	    		$openedFrameBody = $document.find(".menuframebodycontainer:not(.collapsed)");
	    		$document.find(".menuframebodycontainer").slideUp(200,function () {
	    			$(this).addClass("collapsed");
	    		});
		    	$document.find('#tree').animate({"width": '44px'},200);
				$document.find('#main').animate({"left": '44px'},200);
	    	}
	    }

	    checkAllContents = function () {
	    	if($treecontents != null && $maincontents != null && $mainMenucontents != null) {
	    		bindAllContents();
	    	}
	    }

	    bindAllContents = function () {
	    	$treecontents.bind("mousedown touhend", function (e) {
				closesubmenusonclickdocument(e.target);
		    })
		    $maincontents.bind("mousedown touhend", function (e) {
				closesubmenusonclickdocument(e.target);
		    })
		    $mainMenucontents.bind("mousedown touhend", function (e) {
				closesubmenusonclickdocument(e.target);
		    })
		    $document.bind("mousedown touhend", function (e) {
				closesubmenusonclickdocument(e.target);
		    })
		    checkMobileVisibility();
		    checkMobile();
		    checkMobileMain();
		    $window.resize(function (e) {
		    	checkMobileVisibility();
		    	checkMobile();
		    	checkMobileMain();
		    })
	    }

	    closesubmenusonclickdocument = function (target) {
	    	if($(target).closest(".submenuitem").size() == 0 ) {
	    		$document.find(".submenuitem").fadeOut(200, function () {
	    			$(this).remove();
	    		})
	    		if($openSubMenu){
	    			$openSubMenu.removeClass("active");
	    		}
	    	} else {
	    		$document.find(".submenuitem").fadeOut(200, function () {
	    			$(this).remove();
	    		})
	    		if($openSubMenu){
	    			$openSubMenu.removeClass("active");
	    		}
	    	}
	    	if($(target).closest(".submenuitem_left").size() == 0 ) {
	    		$document.find(".submenuitem_left").fadeOut(200, function () {
	    			$(this).remove();
	    		})
	    		if($openSubMenuLeft){
	    			$openSubMenuLeft.removeClass("active");
	    		}
	    	} else {
	    		$document.find(".submenuitem_left").fadeOut(200, function () {
	    			$(this).remove();
	    		})
	    		if($openSubMenuLeft){
	    			$openSubMenuLeft.removeClass("active");
	    		}
	    	}
	    }

    })
})( jQuery );

	function removeLocks() {
		if(confirm("111")==true) {
			top.main.document.location.href="index.php?a=67";
		}
	}