<?php
	session_start();
	
	if(isset($_SESSION['login']) && $_SESSION['login'] != NULL && $_SESSION['senha'] && $_SESSION['senha'] != NULL)
	{
		logedIn();
	}
	
	if(isset($_POST['entrar']))
	{
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['senha'] = $_POST['senha'];
		
		logedIn();
	}
	
	function logedIn()
	{
		$_SESSION['ultima_acao'] = date("Y-m-d H:i:s");
		header("Location: cpro/");	
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CartolaPRO | Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="cpro/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="cpro/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="cpro/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
	<?php include_once("cpro/php/analyticstracking.php") ?>
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b><img src ="cpro/dist/img/prologo.png" width="150px" height="75px"/></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Digite o seu login e senha do CartolaFC</p>
        <form action="#" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="login" class="form-control" placeholder="Login"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="senha" class="form-control" placeholder="Senha"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                                  
            </div><!-- /.col -->
            <div class="col-xs-4">              
              <button type="submit" name="entrar" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div><!-- /.col -->
          </div>
        </form> 
		<br />
		<p class="login-box-msg">Atenção!!! Não armazenamos suas credenciais de acesso ao CartolaFC em nossos servidores.</p>
    <p class="login-box-msg">Para se registrar no CartolaFC acesse o site globo.com ou<a href="https://login.globo.com/cadastro/4728?tam=widget&url=https%3A%2F%2Fintervencao.globo.com%2Fintervencoes%2Fshow.do%3Fpopin%3Dtrue%26servicoId%3D4728%26urlIntervencao%3Dhttp%3A%2F%2Fs.glbimg.com%2Fgl%2Fba%2Fbarra-globocom.callback.html%2523http%253A%252F%252Fgloboesporte.globo.com%252Fcartola-fc%252F"> clique aqui.</a></p>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=1550925368505154";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <center>        
        <div class="fb-share-button" data-href="http://cartolapro.com.br/" data-layout="button_count"></div>
        <div class="fb-send" data-href="http://cartolapro.com.br/"></div>
        <div class="fb-like"></div>
    </center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

		<!-- CartolaPRO -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-1008275499671248"
			 data-ad-slot="6989535413"
			 data-ad-format="auto"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	  </div><!-- /.login-box-body -->	  
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="cpro/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="cpro/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="cpro/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>