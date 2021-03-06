<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./public/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="txtemail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="text" class="btn btn-primary btn-block btn-flat" id="sign_in">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="./public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./public/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>


<script type="text/javascript">

  function my_error(error){
    switch(error) {
      case 400:
          var text = "Bad Request - Request không hợp lệ hoặc bị lỗi khi trao đổi dữ liệu với trình duyệt.";
          break;
      case 401:
          var text = "Unauthorized - Access Token của bạn hết hạn hoặc không hợp lệ.";
          break;
      case 403:
          var text = "Forbidden - Bạn không được quyền truy cập tài nguyên ngày('email hoặc password không hợp lệ').";
          break;
      case 404:
          var text = "Not Found - Tài nguyên bạn muốn truy xuất không tồn tại hoặc đã bị xóa.";
          break;
      case 405:
          var text = "Method Not Allowed - Đường dẫn bạn truy cập không tồn tại.";
          break;
      case 422:
          var text = "Unprocessable Entity - Dữ liệu của bạn gửi lên không hợp lệ hoặc bị lỗi.";
          break;
      case 429:
          var text = "Too Many Requests - Bạn gửi request quá nhanh và đã bị giới hạn truy cập.";
          break;
      case 500:
          var text = "Internal Server Error - Hệ thống Server của Teamcrop đang có vấn đề hoặc không truy cập được.";
          break;
      case 503:
          var text = "Service Unavailable - Hệ thống tạm thời không truy cập được, có thể là chúng tôi đang bảo trì hoăc bị sự cố. Hãy vui lòng thử lại sau.";
          break;
    }

    return console.log(text);
  }


  $('#sign_in').on('click',function(event){
      event.preventDefault()
//    var email = $('input[name="txtemail"]').val();
//    var password = $('input[name="password"]').val();
//     console.log('email = '+email+"+++++ password = "+password);
      functionAjax('admin@gmail.com','admin');
  });

  function functionAjax(email,password){
      $.ajax({
          url: 'http://crm.dev-altamedia.com/api/user/login',
          type: 'POST',
          data: {'email':email,'password':password},
          success: function(data){
              console.log(data);
              if(data.status == 'ok'){
                  var token = data.token;
                  localStorage.setItem("token",token);
                  window.location.href = './customer/add';
              }
              else{
                window.location.href = './login';
              }
          },

          error   : function(jqXHR,status, errorThrown){
              my_error(jqXHR.status);
          }
      });
  }

</script>
</body>
</html>
