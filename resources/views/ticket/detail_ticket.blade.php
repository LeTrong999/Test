@extends('layout_master')
@section('page_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <style>
        #page_ticket ul{
          list-style: none;
          text-align: center;
        }
        .active_page{
            background: red;
        }
        #page_ticket ul li{
            display: inline-block;
            width: 40px;
            height: 40px;
            cursor: pointer;
            line-height: 40px;
            font-size: 22px;
        }
        #detail_ticket{
            background: #ecf0f5;
            overflow: hidden;
        }
    </style>
@endsection()
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Ticket / Detail</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body" >
                        <div class="col-md-12">

                            <h1 style="text-align: center; margin-bottom: 30px;">Thông tin Ticket</h1>
                            <div class="col-md-12" >
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Tiêu đề</span>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input type="text" class="form-control" style="" id="title" placeholder="Enter ..." disabled value="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Tóm lược</span>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="box-body pad" style="padding-left: 0;padding-right: 0">
                                            <textarea class="form-control" id="content" rows="3" placeholder="Enter ..." disabled></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Đính kèm</span>
                                    </div>
                                    <div class="timeline-body" id="img" style="overflow: hidden">

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span>Danh mục</span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter ..." id="category" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <span style="float: right;">Độ ưu tiên</span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter ..." id="priority" disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <hr class="hr">


                    <!-- Content Wrapper. Contains page content -->
                    <div class="content"   id="detail_ticket">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <h1>
                                Comment
                            </h1>

                        </section>
                        <div class="col-xs-12"  >
                            <!-- Main content -->
                            <section class="content">

                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- The time line -->
                                        <ul class="timeline" id="timeline">

                                        </ul>

                                        <div class="row" id="page_ticket">
                                           <ul>
                                               
                                           </ul>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>



                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Timeline Post</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Write in your wall" name="email" type="textarea" id="target" autofocus=""></textarea>
                                    </div>


                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="" id="submit" class="btn btn-primary  btn-success save_ticket" style="float: right">Save Ticket</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
             </form>


        </div>

        <!-- /.box -->
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection




@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            var page = {{$id}};
            $.ajax({
                url: 'http://ticket.dev-altamedia.com/api/ticket/'+page,
                type: 'GET',
                success:function(kq){
                    var title = kq[0]['title'];
                    var content = kq[0]['content'];
                    var category = kq[0]['category']['name'];
                    var priority = kq[0]['priority'];
                    $.each(kq.priority,function(i,v){
                       if(i == priority){
                           $("#priority").val(v);
                       }
                    });

                    if(priority==1){
                        $("#priority").css('color','green');
                    }
                    else if(priority==2){
                        $("#priority").css('color','blue');
                    }
                    else {
                        $("#priority").css('color','red');
                    }
                    $("#title").val(title);
                    $("#content").val(content);
                    $("#category").val(category);
                    for(i=0;i<=kq[0]['detail_file'].length ;i++){
                        $("#img").append('<img src="http://ticket.dev-altamedia.com/hinh/'+kq[0]['detail_file'][i]['file_name']+'/" width="100px" alt="" class="margin">');
                    }
                }
            });
        });

    </script>
    <script type="text/javascript">

        $("#pagination").click(function(event) {
            /* Act on the event */
            alert('dsadsad');
        });

    </script>
    <script type="text/javascript">

        function loadajax(page){
            var ticket_id = {{$id}};


            var html="";
            var li = "";
            $.ajax({
                url: 'http://ticket.dev-altamedia.com/api/ticket_response/'+ticket_id,
                type: 'GET',
                success:function(kq){
                    $.each(kq.data,function(i,v){
                        //console.log(v);//return false;
                        //console.log(v.customers_id);
                        html += '<li><i class="fa fa-user ';
                        if(v.customers_id == null){
                            html +='bg-yellow"></i>';
                        }else{
                            html +='bg-green"></i>';
                        }
                        html += '<div class="timeline-item">';
                        html += '<span class="time" id="time"><i class="fa fa-clock-o"></i> 2018-01-27 20:29:00</span><h3 class="timeline-header no-border"><span style="color:blue">'+v.user_id+'</span>'+v.content+'</h3>';
                        html += '<div class="timeline-body"><img src="http://ticket.dev-altamedia.com/hinh/" width="200px" alt="image" class="margin"></div></div></li>';
                    })

                    $("#timeline").html(html);

                    for(i=1;i<=kq.last_page;i++){
                        li += '<li>'+i+'</li>';
                    }
                    $('#page_ticket ul').html(li);
                    $.getScript("./public/dist/js/test.js");
                }
            });

        }
        loadajax();
        var ticket_id = {{$id}};
        $('#page_ticket li').on('click',function(){
            var html = "";
            var number_page = $(this).html();
            $.ajax({
                url: 'http://ticket.dev-altamedia.com/api/ticket_response/'+ticket_id+'?page='+number_page,
                type: 'GET',
                success:function(kq){
                    $.each(kq.data,function(i,v){
                        html += '<li><i class="fa fa-user ';
                        if(v.customers_id == null){
                            html +='bg-yellow"></i>';
                        }else{
                            html +='bg-green"></i>';
                        }
                        html += '<div class="timeline-item">';
                        html += '<span class="time" id="time"><i class="fa fa-clock-o"></i> 2018-01-27 20:29:00</span><h3 class="timeline-header no-border"><span style="color:blue">'+v.user_id+'</span>'+v.content+'</h3>';
                        html += '<div class="timeline-body"><img src="http://ticket.dev-altamedia.com/hinh/" width="200px" alt="image" class="margin"></div></div></li>';
                    })

                    $("#timeline").html(html);

                    console.log(kq.last_page);
                    for(i=1;i<=kq.last_page;i++){
                        li += '<li>'+i+'</li>';
                    }
                    $('#page_ticket ul').html(li);
                    $.getScript("./public/dist/js/test.js");
                }
            });
        })
    </script>


    <script type="text/javascript">
//        $(function () {
//            CKEDITOR.replace('content')
//            //bootstrap WYSIHTML5 - text editor
//            $('.textarea').wysihtml5()
//        })
        $(document).ready(function() {

            $("#submit").on('click',  function(event) {
                event.preventDefault();
                /* Act on the event */

                target= $("#target").val();


                var ticket_id = {{$id}};
                customers_id=null;
                user_id=1;
                if(target !="")
                {
                    if(customers_id!=null){
                        $.ajax({

                            url : 'http://ticket.dev-altamedia.com/api/ticket_response',

                            type : 'POST',

                            data: 'customers_id='+customers_id+"&content="+target+"&ticket_id="+ticket_id,



                            success: function(data){
                                loadajax();
                                $("#target").val("");
                            },

                            error   : function(jqXHR,status, errorThrown){

                                my_error(jqXHR.status);

                            }

                        });
                    }
                    else{
                        $.ajax({

                            url : 'http://ticket.dev-altamedia.com/api/ticket_response',

                            type : 'POST',

                            data: 'user_id='+user_id+"&content="+target+"&ticket_id="+ticket_id,



                            success: function(data){

                                loadajax();
                                $("#target").val("");
                            },

                            error   : function(jqXHR,status, errorThrown){

                                my_error(jqXHR.status);

                            }

                        });
                    }
                }
            });


        });

    </script>


@endsection



