<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/css/login-styles.css') ?>">
  <link rel="stylesheet" href="<?= base_url('bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <div class="wrapper">
        <?= form_open('login/attempt', 'class="login"') ?>
            <p class="title">USCERT</p>
             <div id="errors" hidden></div>
            <input type="text" placeholder="Username" autofocus name="login_username"/>
            <i class="fa fa-user"></i>
            <input type="password" placeholder="Password" name="login_password"/>
            <i class="fa fa-key"></i>
            <button>
            <i class="spinner"></i>
            <span class="state">Log in</span>
            </button>
        <?= form_close() ?>
        <footer>
            <a target="blank">USCERT &copy; 2016</a>
        </footer>
    </div>
    <script type="text/javascript" src="<?= base_url('bower_components/jquery/dist/jquery.min.js')?>"></script>
    <script type="text/javascript">
        var working = false;
        $('.login').on('submit', function(e) {

            e.preventDefault();

            if (working) return;

            working = true;

            $('#errors').attr('hidden', 'hidden');

            var $this = $(this),
                $state = $this.find('button > .state');

            $this.addClass('loading');
            $state.html('Authenticating');

            $.post($this.attr('action'), $this.serialize())
            .done(function(response){
              if(response.result){
                $this.addClass('ok');
                $state.html('Welcome back!');
                window.location.href = '<?= site_url('dashboard')?>';
              }else{
                  $('#errors').removeAttr('hidden').html('<ul class="list-unstyled"><li>'+response.errors.join('</li><li>')+'</li></ul>')
                 $this.removeClass('ok loading');
              }
            })
            .fail(function(){
              alert('An internal error has occured! Please try again!');
                 $this.removeClass('ok loading');
            })
            .always(function(){
               $state.html('Log in');
               working = false;
            })
        });
    </script>
</body>
</html>
