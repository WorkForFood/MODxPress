<!DOCTYPE html>
<html>
<head>
    <title>MODX CMF Manager Login</title>

	<link rel='stylesheet' href='media/style/[+theme+]/styles/fontAwesome.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/[+theme+]/styles/fonts.css' type='text/css' media='all' />
	<link rel='stylesheet' href='media/style/[+theme+]/styles/frames/login.css' type='text/css' media='all' />

    <script src="media/script/mootools/mootools.js" type="text/javascript"></script>
    <script src="media/style/[+theme+]/scripts/frames/login.js" type="text/javascript"></script>

    <meta http-equiv="content-type" content="text/html; charset=[+modx_charset+]" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

</head>
<body id="login">
<div id="mx_loginbox">
    <form method="post" name="loginfrm" id="loginfrm" action="processors/login.processor.php">
    <!-- anything to output before the login box via a plugin? -->
    [+OnManagerLoginFormPrerender+]
        <div class="sectionHeader" style="margin-top: -105px;">
			<a class="logo" href="../" title="[+site_name+]">
				<img src="media/style/[+theme+]/images/misc/login-logo-small.png" alt="[+site_name+]" id="logo" />
			</a>
		</div>
        <div class="sectionBody">
            <!--<p class="loginMessage">[+login_message+]</p>-->
            <label for="username">[+username+]</label>
            <input type="text" class="text" name="username" id="username" tabindex="1" value="[+uid+]" />
            <label for="password">[+password+]</label>
            <input type="password" class="text" name="password" id="password" tabindex="2" value="" />
            <div class="caption">[+login_captcha_message+]</div>
            <div>[+captcha_image+]</div>
            [+captcha_input+]
			<label for="rememberme" style="cursor:pointer" class="remtext"><input type="checkbox" id="rememberme" name="rememberme" tabindex="4" value="1" class="checkbox fa" [+remember_me+] />[+remember_username+]</label>
            <input type="submit" class="login" id="submitButton" value="[+login_button+]" />
            <div style="clear:both;"></div>
            <div style="padding-top: 20px;">
                <!-- anything to output before the login box via a plugin ... like the forgot password link? -->
                [+OnManagerLoginFormRender+]
                <div style="clear:both;"></div>
            </div>
        </div>
        <div class="sectionBody" style="display: none;">
        	[+OnManagerLoginFormRender+]
            <div style="clear:both;"></div>
        </div>
    </form>
</div>
<!-- close #mx_loginbox -->

<!-- convert this to a language include -->
<p class="loginLicense" >
	
</p>
<div class="gpl">&copy; 2005-2016 by the <a href="http://modx.com/" target="_blank">MODX</a>. <strong>MODX</strong>&trade; is licensed under the GPL. &nbsp;</div>
</body>
</html>