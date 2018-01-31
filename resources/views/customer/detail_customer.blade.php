@extends('detail_customer_master')
@section('page_css')
  {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>--}}
  {{--<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">--}}
  {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>--}}
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{url('public/dist/css/bootstrap-editable-custom.css')}}">
  <style>
      tr td:first-child{
          font-weight: bold;
      }
      tbody tr td{
          border-top: none;
          border-bottom: 1px solid #ddd;
      }
      .infor_pro p{
          margin-top: 20px;
      }
      .infor_pro p a{
          margin-left: 10px;
          font-size: 18px;
      }

  </style>
@endsection()
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Khách Hàng / chi tiết</h1>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-body">

            <div class="col-md-12">
              <h1 style="text-align: center; margin-bottom: 50px;">Thông tin chi tiết khách hàng</h1>
              <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="col-md-6" align="">
                      <div class="col-sm-5">
                        <div  align="center">
                          <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image" class="img-circle img-responsive">
                          <input id="profile-image-upload" class="hidden" type="file">
                        </div>
                      </div>
                      <div class="col-sm-7 infor_pro">

                        <h4 style="color:#00b1b1; display: inline; font-size: 22px;" ><a href="#" id="last_name" data-name="last_name"></a></h4>
                        <p style="margin-top: 20px;"><strong><i class="glyphicon glyphicon-heart"></i> Loại khách hàng:</strong><a href="" id="">Khách Hàng Vip</a></p>
                        <p><strong><i class="glyphicon glyphicon-map-marker"></i> Doanh nghiệp:</strong><a href="">Không</a></p>
                        <p><strong><i class="glyphicon glyphicon-certificate"></i> Trạng thái:</strong><a href=""> Employees</a></p>
                        <p><strong><i class="glyphicon glyphicon-phone"></i> Điện thoại:</strong><a href=""> 0904 420 410</a></p>
                        <p><strong><i class="glyphicon glyphicon-envelope"></i> Email:</strong><a href=""> tuantoihv@gmail.com</a></p>
                      </div>
                      <div style="padding-bottom: 40%;"></div>
                      <table class="table">
                        <tbody id="list_custom">

                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6" align="center">
                      <table class="table table-user-information">
                        <tbody>
                        <tr>
                          <td>Ngày sinh</td>
                          <td><a href="#" id="birthday" data-type="date" data-title="Select date"></a></td>
                        </tr>

                        <tr>
                        <tr>
                          <td>Giới tính</td>
                          <td><a href="#" id="gender" data-type="select" data-placement="right" data-title="Enter gender"></a></td>
                        </tr>
                        <tr>
                            <td>Số CMND</td>
                            <td><a href="#" id="" data-type="select" data-placement="right" data-title="Enter gender">0134565848</a></td>
                        </tr>
                        <tr>
                          <td>Nghành nghề</td>
                          <td><a href="#" id="career" data-type="select" data-placement="right" data-title="Enter gender"></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td><a href="">info@support.com</a></td>
                        </tr>
                        <td>Phone Number</td>
                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)</td>
                        </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>


          </div>
        </div>
        <!-- /.box -->
      </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
  </div>

@endsection
@section('page_script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

  <script>
       var id = {{$id}};
       console.log(id);
      $.fn.editable.defaults.mode = 'inline';
      $.fn.editable.defaults.ajaxOptions = {type: "PUT", dataType: 'json'};

      $.ajax({
          url: 'http://crm.dev-altamedia.com/api/customer/show/'+id,
          type: 'GET',
          success: function (data) {
              console.log(data);
              $('#last_name').editable({
                  value: data.last_name,
                  type:'text',
                  url:'http://crm.dev-altamedia.com/api/customer/ud-last-name/'+data.id,
                  pk: data.id
              });

             $('#gender').editable({
                 value: data.gender,
                 type:'select',
                 url:'http://crm.dev-altamedia.com/api/customer/ud-gender/'+data.id,
                 pk: data.id,
                 source: [{value:"0",text:"Nữ"},{value:"1",text:"Nam"},{value:"2",text:"Khac"}]
             });

              $('#birthday').editable({
                  value: data.birthday,
                  viewformat: 'dd/mm/yyyy',
                  datepicker: {
                      weekStart: 1
                  },
                  format: 'yyyy-mm-dd',
                  url:'http://crm.dev-altamedia.com/api/customer/ud-birthday/'+data.id,
                  pk: data.id,
              });

              $.ajax({
                  url: 'http://crm.dev-altamedia.com/api/career/career',
                  type: 'GET',
                  success: function(career){
                      var newArray = new Array();

                      for(var i = 0; i < career.length; i++) {
                          newArray.push({
                              value: career[i].id,
                              text:  career[i].name
                          });

                      }
                      $('#career').editable({
                          value: data.career_id,
                          type:'select',
                          url:'http://crm.dev-altamedia.com/api/customer/ud-custom-career-name/20',
                          pk: data.id,
                          source: function(){
                              return newArray;
                          }
                      });
                  }
              });

          }
      });
  </script>
  {{--<script>--}}

      {{--var id = {{$id}};--}}
      {{--console.log(id);--}}
    {{--$.ajax({--}}
    {{--url : 'http://crm.dev-altamedia.com/api/customer/show/'+id,--}}
    {{--type : 'GET',--}}
    {{--success: function(data){--}}
    {{--console.log(data);--}}

        {{--$('.last_name').html(data.last_name);--}}
        {{--$('.birth_day').html(data.birthday);--}}
        {{--if(data.gender == 0){--}}
            {{--var gender = "Nữ";--}}
        {{--} else if(data.gender == 1){--}}
            {{--var gender = "Nam";--}}
        {{--}--}}
        {{--$('.sex').html(gender);--}}
        {{--$('.card_id').html(data.card_id);--}}

    {{--},--}}
    {{--error   : function(jqXHR,status, errorThrown){--}}
    {{--my_error(jqXHR.status);--}}
    {{--}--}}
    {{--});--}}

    {{----}}
  {{--</script>--}}
@endsection()



