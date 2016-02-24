		if (top.frames.length!=0) {
            top.location=self.document.location;
        }
        
        window.addEvent('domready', function() {
            $('submitButton').addEvent('click', function(e) {
                 e = new Event(e).stop();
                 params = 'ajax=1&' + $('loginfrm').toQueryString();
                 url = 'processors/login.processor.php';
                 new Ajax(url,
                    {
                        method: 'post',
                        postBody: params,
                        onComplete:ajaxReturn
                    }
                ).request();
                $$('input').setProperty('readonly', 'readonly');
            });  
			
			// Initial focus
			if ($('username').value != '') {
				$('password').focus();
			} else {
				$('username').focus();
			}
			   
        });

        function ajaxReturn(response) {
            var header = response.substr(0,9);
            if (header.toLowerCase()=='location:') top.location = response.substr(10);
            else {
                var cimg = $('captcha_image');
                if (cimg) {
                	cimg.src = 'includes/veriword.php?rand=' + Math.random();
                }
                $$('input').removeProperty('readonly');
                alert(response);
            }
        }