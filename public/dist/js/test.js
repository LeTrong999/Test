//telephone
$("#telephone input").keyup(function(){
	   var val = $(this).val();
	    if(test_regex(val)==true && val.length >= 9 && val.length <= 11){
	    	$(this).closest('.class_root').find('.flag_block').removeClass('icon_circletop');
	    }else {

	    	$(this).closest('.class_root').find('.flag_block').addClass('icon_circletop');
	    }
	}); 

$('.deleteicon').on('click', function(event) {
		event.preventDefault();
		$(this).closest('.class_root').find('.flag_block').removeClass('icon_circletop');
		$(this).closest('.parent-delete').remove();
	});


//email
$("#email input").keyup(function(){
	    var val = $(this).val();
	    if(test_regex(null,val)==true){
	    	$(this).closest('.class_root').find('.flag_block').removeClass('icon_circletop');
	    }else{
	    	$(this).closest('.class_root').find('.flag_block').addClass('icon_circletop');
	    }
	});

//address
//regex address
$("#address input").keyup(function(){
    var val = $(this).val();
    if(test_regex(null,null,val)==true){
        $(this).closest('.class_root').find('.flag_block').removeClass('icon_circletop');

    }else{
        $(this).closest('.class_root').find('.flag_block').addClass('icon_circletop');
    }
});


$('#page_ticket li').on('click',function(){
	var position = $(this).index();
	console.log(position);
	var li = "";
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

            for(i=1;i<=kq.last_page;i++){
                li += '<li>'+i+'</li>';
            }
            $('#page_ticket ul').html(li);
			$('#page_ticket > ul li:eq('+position+')').addClass('active_page');
            $.getScript("./public/dist/js/test.js");
		}
	});
})