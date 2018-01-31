@extends('layout_master')
@section('page_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection()

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Khách Hàng / Danh sách</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <input type="hidden" value="" id="tmp_idDelete">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-body">
                  <div class="col-md-12">
                    <div class="row">
                        <table class="table table-bordered table-striped" style="text-align: center;" id="list_customer">
                          <thead>
                            <tr>
                              <th width="" style="text-align: center;">ID</th>
                              <th width="" style="text-align: center;">Tên khách hàng</th>
                              <th width="" style="text-align: center;">Ngày sinh</th>
                              <th width="" style="text-align: center;">Giới tính</th>
                              <th width="" style="text-align: center;">Tình trạng</th>
                              <th width="" style="text-align: center;">Create_at</th>
                              <th width="" style="text-align: center;">Update_at</th>
                              <th width="" style="text-align: center;">Action</th>

                            </tr>

                          </thead>

                        </table>

                    </div>
                  </div>


                </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>


@endsection

@section('page_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">


    function test(){
        $('#list_customer').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://crm.dev-altamedia.com/api/customer/anydata',
            columns: [
                { data: 'id' },
                { data: 'last_name' },
                { data: 'birthday' },
                { data: 'gender' },
                { data: 'status' },
                { data: 'created_at' },
                { data: 'updated_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    }
    test();

    function myClick(id){
          $('#tmp_idDelete').val(id);
//        $('.delete_cus').css('display','block');
        toastr.error("<br /><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button><button type='button' id='confirmationRevertNo' class='btn' style='margin-left: 10px;'>No</button>",'Bạn có chắc chắn xóa khách hàng này?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationRevertYes").click(function(){
                        var id = $('#tmp_idDelete').val();
                        console.log(id);
                        $.ajax({
                            url : 'http://crm.dev-altamedia.com/api/customer/delete/'+id,
                            type : 'DELETE',
                            success: function(data){
                                console.log(data);
                                if(data.status == "ok"){
                                    toastr.success('Bạn xóa thành công');
                                    $('#customer_'+data.id).closest('tr').remove();
//                    setTimeout(function () {
//                        location.reload();
//                    },3000)
                                }

                            },
                            error   : function(jqXHR,status, errorThrown){
                                my_error(jqXHR.status);
                                toastr.error('Bạn xóa thất bại!!! Vui lòng kiểm tra lại');
                            }
                        });
                    });

                    $("#confirmationRevertNo").click(function(){
                        console.log('clicked No');
                        toastr.clear();
                    });
                },
                showDuration: "5000",
            });
//        toastr["error"]('Bạn có chắc chắn xóa khách hàng này?<br /><br /><button id="confirmationRevertYes" type="button" class="btn clear">Yes</button><button type="button" class="btn" style="margin-left: 10px;">No</button>',{
//                closeButton: false,
//                allowHtml: true,
//                onShown: function (toast) {
//                    $("#confirmationRevertYes").click(function(){
//                        console.log('clicked yes');
//                    });
//                }
//        });

//        toastr.options = {
//            "closeButton": false,
//            "debug": false,
//            "newestOnTop": false,
//            "progressBar": false,
//            "positionClass": "toast-top-right",
//            "preventDuplicates": false,
//            "onclick": null,
//            "showDuration": "300",
//            "hideDuration": "1000",
//            "timeOut": 0,
//            "extendedTimeOut": 0,
//            "showEasing": "swing",
//            "hideEasing": "linear",
//            "showMethod": "fadeIn",
//            "hideMethod": "fadeOut",
//            "tapToDismiss": false
//        }
    }
  $('.btn_close').on('click',function(event) {
      event.preventDefault();
      $('.delete_cus').css('display','none');
  });
  $('.btn_delete').on('click',function(event) {
        event.preventDefault();
        var id = $('#tmp_idDelete').val();
        console.log(id);
        $.ajax({
            url : 'http://crm.dev-altamedia.com/api/customer/delete/'+id,
            type : 'DELETE',
            success: function(data){
                console.log(data);
                if(data.status == "ok"){
                    $('.delete_cus').css('display','none');
                    toastr.success('Bạn xóa thành công');
                    $('#customer_'+data.id).closest('tr').remove();
//                    setTimeout(function () {
//                        location.reload();
//                    },3000)
                }

            },
            error   : function(jqXHR,status, errorThrown){
                 my_error(jqXHR.status);
                toastr.error('Bạn xóa thất bại!!! Vui lòng kiểm tra lại');
            }
        });
  })

</script>

@endsection


