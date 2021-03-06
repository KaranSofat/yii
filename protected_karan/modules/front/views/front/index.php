
<div class="content" style= "float: left;
   
    width: 38%;">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/front/front/login" method="post">
		<h3 class="form-title">Sign In</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase">Login</button>
			<label class="rememberme check">
			<input type="checkbox" name="remember" value="1"/>Remember </label>
			<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
		</div>
		<div class="login-options">
			<h4>Or login with</h4>
			
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/images.jpeg" style=" height: 34px;
    width: 91px;"></img>
				
		</div>
		
	</form>
	</div>
	<div style="float: left;
   width:50%; margin-left:94px;">
	<div id="hero-content">
            <div id="close"><a title="click to minimize">_</a></div>
        <div id="blurb">
            Stack Overflow is a question and answer site for professional and enthusiast programmers. It's 100% free.
            <br>
            <br>
            <a class="button" id="tell-me-more" href="/tour">Take the 2-minute tour</a>
        </div>
        <div id="desc">
            <b>Here's how it works:</b>
            <ol id="hiw">
                <li id="q">Anybody can ask a question
                </li>
                <li id="an">Anybody can answer
                </li>
                <li id="b">The best answers are voted up and rise to the top
                </li>
            </ol>
        </div>
        <div style="clear: both"></div>
        <div class="col-full">
                <p>
                    
</p><div data-placeholder="WikiPlaceholder-AboutThisSite" class="wiki-ph">
    <div class="wiki-ph-content"><p><strong>Stack Overflow</strong> is a question and answer site for professional and enthusiast programmers. It's built and run <em>by you</em> as part of the <a href="http://stackexchange.com">Stack Exchange</a> network of Q&amp;A sites. With your help, we're working together to build a library of detailed answers to every question about programming.</p>
</div> 


</div>
                <p></p>

                <p class="helper-text">
                        We're a little bit different from other sites. Here's how:
                </p>
            </div>
    </div>
    
	</div>
	<style>
	#hero-content > div {
    float: left;
    font-family: caption;
    font-size: 18px;
}
	</style>
	
	
	<!-- END LOGIN FORM -->
	
