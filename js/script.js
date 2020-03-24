$(document).ready(function(){
	/*** search bar ****/
	$("#searchinput").keyup(function(){
		$("ul.search-list").css("display", "block");
		$.ajax({
			url: siteURL+"scripts.php",
			type: "POST",
			data:  {action:"search", keyword:$(this).val()},
      success:function(res){				
				$("#searchlist").empty();
				var data = $.parseJSON(res);
				if(data.length != 0){
					$.each(data, function(index,value) {
						li = '<li>';
						li += ' <a href="'+value["url"]+'">';
						li += '  <img src="'+value["image"]+'">'+value["name"];					
						li += ' </a>';
						li +='</li>';
						$("#searchlist").append(li);
					});
				}
				else{
					$("#searchlist").append('<li class="noresult">No Category or Product found</li>');
				}
      }
    });
	});
	$("#searchinput").focusout(function(){
		$("ul.search-list").css("display", "none");
	});
	/*** search bar ****/

	/*** mainslider starts ****/
	$('.main-carousel').owlCarousel({
	    loop:true,
	    autoplay:true,
    	autoplayTimeout:3000,
    	autoplayHoverPause:true,
    	smartSpeed: 1000,
	    margin:0,
	    nav:false,
	    items: 1,
	    /*dotClass: 'owl-dot',
		dotsClass: 'owl-dots',*/
	    dots:false
	});
	/*** mainslider ends ****/

	/*** category starts ****/
	$('.category-carousel').owlCarousel({
	    loop:true,
	    center:true,
	    autoplay:false,
    	/*autoplayTimeout:3000,
    	autoplayHoverPause:true,*/
    	smartSpeed: 1000,
	    margin:0,
	    items: 7,
	    dots:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:2,
				nav:false
			},
			768:{
				items:4,
				nav:false
			},
			1000:{
				items:6,
				nav:false
			}
		}
	});
	/*** category ends ****/

	/*** categorycontent starts ****/
	$('.categorycontent-carousel').owlCarousel({
	    loop:false,
	    rewind: true,
	    autoplay:false,
    	smartSpeed: 1000,
	    margin:10,
	    items: 4,
	    dots:false,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			600:{
				items:2,
				nav:false
			},
			1000:{
				items:4,
				nav:false
			}
		}
	});
	/*** categorycontent ends ****/

	/*** ourbrands starts ****/
	$('.ourbrands-carousel').owlCarousel({
	    loop:true,
	    autoplay:true,
    	autoplayTimeout:3000,
    	autoplayHoverPause:true,
    	smartSpeed: 1000,
	    margin:10,
	    nav:false,
	    items: 5,
	    dotClass: 'owl-dot',
			dotsClass: 'owl-dots',
	    dots:true,
			responsiveClass:true,
			responsive:{
				0:{
					items:2
				},
				768:{
					items:4
				},
				1000:{
					items:5
				}
			}
	});
	/*** ourbrands ends ****/

	/*** product slider starts ****/
	$('.single-slide-menu').owlCarousel({
		loop:false,
	    rewind: true,
	    margin:8,
	    dots:false,
	    smartSpeed: 500,
		responsiveClass:true,
		navText: ["<i class='fas fa-angle-left'></i>","<i class='fas fa-angle-right'></i>"],
		//navClass : ['btn btn-default','btn btn-default'],
		responsive:{
			0:{
				items:2,
				nav:true
			},
			992:{
				items:3,
				nav:true
			}
		}
	});
	/*** product slider ends ****/

	/*** single product active show ****/
	$('.single-slide-menu a').on('click',function(e){
      e.preventDefault();
     
      var $href = $(this).attr('href');     
      $('.single-slide-menu a').removeClass('active');
      $(this).addClass('active');     
      $('.product-details-large .tab-pane').removeClass('in active');
      $('.product-details-large '+ $href ).addClass('in active');     
 	 });
	/*** single product active show ****/

	$("div.slider-content").click(function(){
		$(this).addClass('active');
		$(this).parent().siblings().children().removeClass('active');		
	});

	/****** customer login form  *******/
	$("#custloginform").on('submit',(function(e){
		e.preventDefault();
		err=0;
		var loginData = new FormData(this);
		loginData.append("action","custlogin");

		$("#login_restxt").show();
		if(err==0){
			$.ajax({
				url: siteURL+"scripts.php",
				type: "POST",
				data:  loginData,
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function() {
					$("#login_restxt").show();
					$("#login_restxt").html("<span class='process'><i class='fa fa-spinner fa-pulse fa-fw'></i>&nbsp;&nbsp;Please wait...</span>");
				},
				success: function(response) {
					if(response == "1"){
					  $("#login_restxt").show();
						$("#login_restxt").html("<span class='succ'>Login success</span>");
						//window.location.href=siteURL;
						window.location.href=lastPAGE;
					}
					else{
					  	$("#login_restxt").show();
					  	$("#login_restxt").html("<span class='err'>Invalid email or password</span>");
					}			
				},
				error: function(e) {
					$("#login_restxt").show();
					$("#login_restxt").html("<span class='err'>Error try again...</span>");
				}
			});
		}		
	}));
	/****** customer login form  *******/

	/****** registration form ******/
	$("#registerform").on('submit',(function(e){
		e.preventDefault();
		err=0;
		var regData = new FormData(this);
		regData.append("action","custregister");

		var fname = $("#firstname").val();
		var lname = $("#lastname").val();
		var email = $("#email").val();
		var mobileno = $("#mobileno").val();
		var password = $("#password").val();
		var repassword = $("#repassword").val();

		$("#reg_restxt").show();
		if(fname=='' || lname=='' || email=='' || mobileno=='' || password=='' || repassword==''){
			err=1;
		 	$("#reg_restxt").html("<span class='err'>Fill all fields...</span>");
		}
		else if(!isValidEmailAddress(email)){
			err=1;
			$("#reg_restxt").html("<span class='err'>Enter valid email</span>");
		}
		else if(mobileno.length<10){
			err=1;
			$("#reg_restxt").html("<span class='err'>Enter valid 10 digit mobile no.</span>");
		}
		else if(password!=repassword){
			err=1;
			$("#reg_restxt").html("<span class='err'>Password mismatch...</span>");
		}
		else{
			err=0;
		}

		if(err==0){
			$.ajax({
				url: siteURL+"scripts.php",
				type: "POST",
				data:  regData,
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function() {
					$("#reg_restxt").show();
					$("#reg_restxt").html("<span class='process'><i class='fa fa-spinner fa-pulse fa-fw'></i>&nbsp;&nbsp;Please wait...</span>");
				},
				success: function(response) {
					if(response == "1"){
					  $("#reg_restxt").show();
						$("#reg_restxt").html("<span class='succ'>Successfully registered</span>");
						window.location.href=siteURL;
					}
					else if(response == "2"){
					  $("#reg_restxt").show();
						$("#reg_restxt").html("<span class='err'>Email already registered.</span>");
					}
					else{
						$("#reg_restxt").show();
						$("#reg_restxt").html("<span class='err'>Error try again...</span>");
					}			
				},
				error: function(e) {
					$("#reg_restxt").show();
					$("#reg_restxt").html("<span class='err'>Error try again...</span>");
				}
			});
		}
	}));
	/****** registration form ******/
	
	/***** addcart form submit starts ********/
	$("#addtocart").on('submit',(function(e){
		e.preventDefault();
		
		var qty = $("#qty").val();

		//check if customer logged in
		if(cusSES==''){
		  $("#loaderdiv").show().html(''); 
		  $('#loaderdiv').html("<span class='err'>You need to login.</span>").delay(4000).fadeOut('slow');   
		}
		else if(qty==0 || qty=='' || isNaN(qty)){
			$("#loaderdiv").show().html(''); 
		  $('#loaderdiv').html("<span class='err'>Invalid quantity.</span>").delay(4000).fadeOut('slow');
		}
		else{
		  var check = true;
			var prodtyp = prod_type;
			
		  if(prodtyp==2){
				$("input:radio").each(function(){
					var name = $(this).attr("name");
					if($("input:radio[name='"+name+"']:checked").length == 0){
					check = false;
					}
				});
		  }
	
		  if(check){
				var cartData = new FormData(this);
				cartData.append("action","addtocart");
				//ajax
				$.ajax({
					url : siteURL+"scripts.php",
					type : "post",
					data : cartData,
					contentType : false,
					cache : false,
					processData : false,
					beforeSend: function(){   
						$("#loaderdiv").show().html('');   
						$("#loaderdiv").html("<span class='process'>Please wait...</span>");
					},
					success: function(response){ 
						$("#qty").val('1');
						var data = $.parseJSON(response);
						if(data.status==1){
							$("#loaderdiv").html("<span class='succ'>Product added to cart</span>");
							$(".count").html(data.cartcount);
							$("#sidecartmenu .side-outer").html('');
							$.each(data.products, function(index, val) {
							cart = '<div class="cartproduct">';
							cart+= ' <div class="primg">';
							cart+= '   <a href="'+siteURL+val.slug+'" class="prinnrimg">';
							cart+= '     <img src="'+siteURL+val.image+'" class="img-responsive">';
							cart+= '   </a>';
							cart+= ' </div>';
							cart+= ' <div class="prdets">';
							cart+= '   <a href="'+siteURL+val.slug+'">'+val.prodname+'</a>';
			
							$("#carpdops"+val.cartid).html('');
							cart+= '   <div id="carpdops'+val.cartid+'">';
							$.each(val.options, function(index, opsval) {
								cart+= ' <span class="proops">- '+opsval.option+' : '+opsval.optval+'</span>'; 
								$("#carpdops"+val.cartid).append(cart);
							});
							cart+= '   </div>';
			
							cart+= ' </div>';
							cart+= ' <div class="prqty">x '+val.qty+'</div>';
							cart+= ' <div class="prcrprice">Rs. '+val.totprodprice+'</div>';
							cart+= ' <div class="prremov'+val.cartid+'"><button onclick="removecart('+val.cartid+')" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></button></div>';
							cart+='</div>';   
							$("#sidecartmenu .side-outer").append(cart);
							});
							total= '<div class="total"><div>Total</div><div>Rs. '+data.total+'</div></div>';
							$("#sidecartmenu .side-outer").append(total);      
						}
						else{
							$("#loaderdiv").html("<span class='err'>Product not added...</span>");
						}
					},
					error: function(xhr){
						$("#qty").val('1');
						$("#loaderdiv").html("<span class='err'>Error try again...</span>");
					}
				}); 
				//ajax
				$('#loaderdiv').delay(4000).fadeOut('slow');      
		  }
		  else{
				$("#loaderdiv").html("<span class='err'>Select Product option</span>");      
		  }
		}
	}));
	/***** addcart form submit ends ********/

	/***** myaccount form submit starts ********/
	$("#myaccountForm").on('submit',(function(e) {
		e.preventDefault();
		err=0;

		var inputfirstname = $("#input-firstname").val();
		var inputlastname = $("#input-lastname").val();
		var inputemail = $("#input-email").val();
		var inputtelephone = $("#input-telephone").val();

		if(inputfirstname=='' || inputlastname=='' || inputemail=='' || inputtelephone==''){
			err=1;
			$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Fill all fields</div>');
			scrolltoerror('myaccrestxt');
		}
		else if(!isValidEmailAddress(inputemail)){
			err=1;
			$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter valid email</div>');
			scrolltoerror('myaccrestxt');
		}
		else if(inputtelephone.length<10){
			err=1;
			$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter 10 digit valid mobile no.</div>');
			scrolltoerror('myaccrestxt');
		}
		else{
			err=0;
		}

		if(err==0) {
			var accData = new FormData(this);
			accData.append("action","myaccount");
			//ajax
			$.ajax({
				url : siteURL+"scripts.php",
				type : "post",
				data : accData,
				contentType : false,
				cache : false,
				processData : false,
				beforeSend: function(){   
					$("#myaccrestxt").show().html('');   
					$("#editaccount").prop('disabled', true).html('Processing...');
				},
				success: function(response){
					if(response==1){
						$("#myaccrestxt").html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> Success: Your account has been successfully updated.</div>'); 
						scrolltoerror('myaccrestxt');
						$('#editaccount').removeAttr("disabled").html('Submit');
					}
					else{
						$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
						scrolltoerror('myaccrestxt');
						$('#editaccount').removeAttr("disabled").html('Submit');
					}
				},
				error: function(xhr){
					$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
					scrolltoerror('myaccrestxt');
					$('#editaccount').removeAttr("disabled").html('Submit');
				}
			}); 
		}

	}));
	/***** myaccount form submit ends ********/

	/***** password form submit starts ********/
	$("#passwdForm").on('submit',(function(e){
		e.preventDefault();
		err=0;

		var pass = $("#input-password").val();
		var passconf = $("#input-confirm").val();

		if(pass=='' || passconf=='') {
			err=1;
			$("#myaccrestxt").show().html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter Password & Confirm Password fields</div>');
			scrolltoerror('myaccrestxt');
		}
		else if(pass!=passconf) {
			err=1;
			$("#myaccrestxt").show().html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Password mismatch</div>');  
			scrolltoerror('myaccrestxt');
		}
		else{
			err=0;
		}

		if(err==0){
			var accData = new FormData(this);
			accData.append("action","accountpwd");
			//ajax
			$.ajax({
				url : siteURL+"scripts.php",
				type : "post",
				data : accData,
				contentType : false,
				cache : false,
				processData : false,
				beforeSend: function(){   
					$("#myaccrestxt").show().html('');   
					$("#passwdbtn").prop('disabled', true).html('Processing...');
				},
				success: function(response){
					if(response==1){
						$("#myaccrestxt").html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> Success: Your account has been successfully updated.</div>'); 
						scrolltoerror('myaccrestxt');
						$('#passwdbtn').removeAttr("disabled").html('Submit');
					}
					else{
						$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
						scrolltoerror('myaccrestxt');
						$('#passwdbtn').removeAttr("disabled").html('Submit');
					}
				},
				error: function(xhr){
					$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
					scrolltoerror('myaccrestxt');
					$('#passwdbtn').removeAttr("disabled").html('Submit');
				},
        complete: function() {
          $('#passwdForm')[0].reset();
        }
			});
			//ajax
		}

	}));
	/***** password form submit ends ********/

	/**** myaccount address submit form ****/
	$("#addressForm").on('submit',(function(e) {
		e.preventDefault();
		err=0;
		
		var addrfname = $("#addr_fname").val();
		var addrlname = $("#addr_lname").val();
		var addraddress1 = $("#addr_address1").val();
		var addrcity = $("#addr_city").val();
		var addrpostcode = $("#addr_postcode").val();

		if(addrfname=='' || addrlname=='' || addraddress1=='' || addrcity=='' || addrpostcode==''){
			err=1;
			$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Fill all fields marked with *</div>');
			scrolltoerror('myaccrestxt');
		}
		else{
			err=0;
		}

		if(err==0){
			var accData = new FormData(this);
			accData.append("action","accountaddress");
			//ajax
			$.ajax({
				url : siteURL+"scripts.php",
				type : "post",
				data : accData,
				contentType : false,
				cache : false,
				processData : false,
				beforeSend: function(){   
					$("#myaccrestxt").show().html('');   
					$("#addrsbtn").prop('disabled', true).html('Processing...');
				},
				success: function(response){
					if(response==1){
						$("#myaccrestxt").html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> Success: Your account has been successfully updated.</div>'); 
						scrolltoerror('myaccrestxt');
						$('#addrsbtn').removeAttr("disabled").html('Submit');
					}
					else{
						$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
						scrolltoerror('myaccrestxt');
						$('#addrsbtn').removeAttr("disabled").html('Submit');
					}
				},
				error: function(xhr){
					$("#myaccrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Error updating...</div>'); 
					scrolltoerror('myaccrestxt');
					$('#addrsbtn').removeAttr("disabled").html('Submit');
				},
        complete: function() {
					setTimeout(function(){ window.location.href=siteURL+'account/addresses'; }, 2000);          
        }
			});
			//ajax
		}

	}));
	/**** myaccount address submit form ****/

	/**** on product option change ******/
	$('input:radio.inputradio').change(function(){
		var cartData = new FormData($('#addtocart')[0]);
		cartData.append("action","productoption");
		$.ajax({
		  url : siteURL+"scripts.php",
		  type : "post",
		  data : cartData,
		  contentType : false,
		  cache : false,
		  processData : false,
		  beforeSend: function(){   
			$("#loaderdiv").show().html('');        
		  },
		  success: function(response){
			var obj = $.parseJSON(response);
			$("#sellprice").html(obj.sellprice);$("#mrp").html(obj.mrp); 
			$("#prod_unitprice").val(obj.sellprice)
			
			if(prod_qty!=0){
			  if(obj.stock==0){
				$('#btn-addcart').prop('disabled', true);
				$("#loaderdiv").html('Out of stock');
			  }          
			  else{
				$('#btn-addcart').removeAttr("disabled");
				$("#loaderdiv").html('');
			  }
			}                  
		  },
		  error: function(xhr){
			$("#loaderdiv").html("<span class='err'>Error try again...</span>");
		  }
		}); 
		//ajax
	});
	/**** on product option change ******/

	/**** checkout delivery details hide & change ****/
	$("#shipping-address").hide();
  $('#shipping').change(function() {
    delv();
	});
	/**** checkout delivery details hide & change ****/

	/***** checkout form procedd payment *****/
	$("#checkoutForm").on('submit',(function(e){
		e.preventDefault();
		err=0;

		var payaddress = $("input[name='payment_address']:checked").val();
		var deladdress = $("input[name='delivery_address']:checked").val();
		
    var billfirstname = $("#bill-firstname").val();
    var billlastname = $("#bill-lastname").val();
    var billemail = $("#bill-email").val();
    var billtelephone = $("#bill-telephone").val();
    var billaddress1 = $("#bill-address1").val();
    var billcity = $("#bill-city").val();
    var billpostcode = $("#bill-postcode").val();
    var billcountry = $("#bill-country").val();
    var billstate = $("#bill-state").val();

    var delifirstname = $("#deli-firstname").val();
    var delilastname = $("#deli-lastname").val();
    var deliemail = $("#deli-email").val();
    var delitelephone = $("#deli-telephone").val();
    var deliaddress1 = $("#deli-address1").val();
    var delicity = $("#deli-city").val();
    var delipostcode = $("#deli-postcode").val();
    var delicountry = $("#deli-country").val();
    var delistate = $("#deli-state").val();

    if(cartCOUNT==0){
			err=1;
			$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> There are no items in your cart. <a href="'+siteURL+'">Continue Shopping</a></div>');
			scrolltoerror('checkrestxt');
		}  
		/*** if billing new *****/  
		else if(payaddress!='existing'){
			/*** for checking billing fields *****/
			if(billfirstname=='' || billlastname=='' || billemail=='' || billtelephone=='' || billaddress1=='' || billcity=='' || billpostcode=='' || billcountry=='' || billstate==''){
				err=1;
				$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Fill all Billing mandatory fields with *</div>');
				scrolltoerror('checkrestxt');
			} 
			else if(!isValidEmailAddress(billemail)){
				err=1;
				$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter valid Billing email address</div>');
				scrolltoerror('checkrestxt');
			}
			else if(billtelephone.length < 10){
				err=1;
				$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter 10 digit valid Mobile no.</div>');
				scrolltoerror('checkrestxt');
			}
			else if(billpostcode.length < 6){
				err=1;
				$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter 6 digit valid Pincode</div>');
				scrolltoerror('checkrestxt');
			}
			/*** check billing & delivery samee ****/
			else if(!$('input#shipping').is(':checked')) {
				/**** if delivery new ****/
				if(deladdress!='existing'){
					if(delifirstname=='' || delilastname=='' || deliemail=='' || delitelephone=='' || deliaddress1=='' || delicity=='' || delipostcode=='' || delicountry=='' || delistate==''){
						err=1;
						$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Fill all Delivery mandatory fields with *</div>');
						scrolltoerror('checkrestxt');
					} 
					else if(!isValidEmailAddress(deliemail)){
						err=1;
						$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter valid Delivery email address</div>');
						scrolltoerror('checkrestxt');
					}
					else if(delitelephone.length < 10){
						err=1;
						$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter 10 digit valid Mobile no.</div>');
						scrolltoerror('checkrestxt');
					}
					else if(delipostcode.length < 6){
						err=1;
						$("#checkrestxt").html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-times-circle"></i> Enter 6 digit valid Pincode</div>');
						scrolltoerror('checkrestxt');
					}
					else{
						err=0;
					}
				}
				/**** if delivery new ****/
			}
			/*** check billing & delivery samee ****/
			else{
				err=0;      
			}
			/*** for checking billing fields *****/
		}
		/*** if billing new *****/  
    else{
			err=0;      
		} 

		if(err==0){ $('#checkoutForm')[0].submit(); }
	
	}));
	/***** checkout form procedd payment *****/
	
	/***** checkout billing radio checked ******/
	var payaddress = $("input[name='payment_address']:checked").val();
	if(payaddress=='existing'){
		$("#payment-existing").show();
		$("#payment-new").hide();
	}
	else{
		$("#payment-new").show();
		$("#payment-existing").hide();
	}

	$('input:radio[name="payment_address"]').change(function(){
		if($(this).val() == 'existing') {			
			$("#payment-existing").show();
			$("#payment-new").hide();
		}
		else{
			$("#payment-new").show();
			$("#payment-existing").hide();
		}
	});
	/***** checkout billing radio checked ******/

	/***** checkout billing radio checked ******/
	var deladdress = $("input[name='delivery_address']:checked").val();
	if(deladdress=='existing'){
		$("#delivery-existing").show();
		$("#delivery-new").hide();
	}
	else{
		$("#delivery-new").show();
		$("#delivery-existing").hide();
	}

	$('input:radio[name="delivery_address"]').change(function(){
		if($(this).val() == 'existing') {			
			$("#delivery-existing").show();
			$("#delivery-new").hide();
		}
		else{
			$("#delivery-new").show();
			$("#delivery-existing").hide();
		}
	});
	/***** checkout billing radio checked ******/

});
/*** document ready *****/

/***** qty increment & decrement *****/
$(".qtybutton").on("click",function(){
	var newqty;
	var $button = $(this); 
	var qty = $("#qty").val();
	if(qty==0 || qty=='' || isNaN(qty)){ qty=1; } else { qty=Math.floor(qty);}
	if ($button.text() == '+') {
	  newqty = parseInt(qty)+1;
	  $("#qty").val(newqty);
	}
	else{
	  if(qty > 1){
		newqty = parseInt(qty)-1;
		$("#qty").val(newqty);
	  }
	}  
});
/***** qty increment & decrement *****/

/***** product removecart ******/
function removecart(id){
	
	if(id!=''){
		//ajax
		$.ajax({
			url : siteURL+"scripts.php",
			type : "post",
			data : { action: "removecart", cartid : id} ,
			beforeSend: function(){   
				$(".prremov"+id+" button").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');    
			},
			success: function(response){   				
			  	var data = $.parseJSON(response);
			  	if(data.status==1){
					$(".count").html(data.cartcount);
					$("#sidecartmenu .side-outer").html('');
					$.each(data.products, function(index, val) {
						cart = '<div class="cartproduct">';
						cart+= ' <div class="primg">';
						cart+= '   <a href="'+siteURL+val.slug+'" class="prinnrimg">';
						cart+= '     <img src="'+siteURL+val.image+'" class="img-responsive">';
						cart+= '   </a>';
						cart+= ' </div>';
						cart+= ' <div class="prdets">';
						cart+= '   <a href="'+siteURL+val.slug+'">'+val.prodname+'</a>';
			
						$("#carpdops"+val.cartid).html('');
						cart+= '   <div id="carpdops'+val.cartid+'">';
						$.each(val.options, function(index, opsval) {
							cart+= ' <span class="proops">- '+opsval.option+' : '+opsval.optval+'</span>'; 
							$("#carpdops"+val.cartid).append(cart);
						});
						cart+= '   </div>';
			
						cart+= ' </div>';
						cart+= ' <div class="prqty">x '+val.qty+'</div>';
						cart+= ' <div class="prcrprice">Rs. '+val.totprodprice+'</div>';
						cart+= ' <div class="prremov'+val.cartid+'"><button onclick="removecart('+val.cartid+')" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></button></div>';
						cart+='</div>';  
						$("#sidecartmenu .side-outer").append(cart);
					});
					total= '<div class="total"><div>Total</div><div>Rs. '+data.total+'</div></div>';
					$("#sidecartmenu .side-outer").append(total);
			  	}
			  	else{
					
			  	}
			},
			error: function(xhr){
				
			}
		}); 
		//ajax
	}
}
/***** product removecart ******/

function showcatdiv(catid){
	$(".carouseldiv").css("display", "none");
	$("#catshowdiv_"+catid).show();
}

/***** redirect url ********/
function redirecturl(){
	window.location.href=siteURL+"cart";
}
/***** redirect url ********/

/***** menu open & close *******/
function opensidenavmenu() {
	$("#sidenavmenu").css({"transform": "translate3d(0,0,0)"});
	$(".overlaybg").css({"width": "100%", "opacity": "0.8"});
}
function closesidenavmenu() {
	$("#sidenavmenu").css({"transform": "translate3d(-100%,0,0)"});
	$(".overlaybg").css({"width": "0", "opacity": "0"});	
}
/***** menu open & close *******/

/****** cart open & close *******/
function opencartmenu(){
	$("#sidecartmenu").css({"transform": "translate3d(0,0,0)"});
	$(".cartoverlaybg").css({"width": "100%", "opacity": "0.8"});
}
function closesidecartmenu(){
	$("#sidecartmenu").css({"transform": "translate3d(100%,0,0)"});
	$(".cartoverlaybg").css({"width": "0", "opacity": "0"});	
}
/****** cart open & close *******/

/****** update cartqty *******/
function updatecart(id,subaction,produnitprice){
	var qty = $("#pro_qty"+id).val();
	if(qty==0 || qty=='' || isNaN(qty)){
		qty = 1;
	}
	else{
		qty = Math.floor(qty);
	}

	//ajax
	$.ajax({
		url : siteURL+"scripts.php",
		type : "post",
		data : { action: "updateqtycart",cartid:id,subaction:subaction ,qty : qty,prod_unitprice : produnitprice} ,
		beforeSend: function(){   
			$("#updcartinput"+id+" button").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');    
		},
		success: function(response){   				
			var data = $.parseJSON(response);
			if(data.status==1){
				$("#tblcartbody").html('');
				$.each(data.products, function(index, val) {
					cart = '<tr>';
					cart+= ' <td>'
					cart+= '  <div class="primg">';
					cart+= '   <a href="'+siteURL+val.slug+'" class="prinnrimg"><img src="'+siteURL+val.image+'" class="img-responsive"></a>';
					cart+= '  </div>';
					cart+= ' </td>';
					cart+= ' <td>';
					cart+= '  <a class="prodname" href="'+siteURL+val.slug+'">'+val.prodname+'</a>';
					
					$("#cartpdopsvl"+val.cartid).html('');
					cart+= '  <div id="cartpdopsvl'+val.cartid+'">';
					$.each(val.options, function(index, opsval) {
						cart+= ' <span class="proops"> '+opsval.option+' : '+opsval.optval+'</span>'; 
						$("#cartpdopsvl"+val.cartid).append(cart);
					});
					cart+= '  </div>';
					
					cart+= ' </td>';
					cart+= ' <td>';
					cart+= '  <div id="updcartinput'+val.cartid+'" class="input-group" style="max-width:200px;">';
					cart+= '   <input type="tel" id="pro_qty'+val.cartid+'" class="form-control" value="'+val.qty+'" onkeypress="return enterNumerics(event);">';
					cart+= '   <span class="input-group-btn">';
					cart+= '    <button onclick="updatecart('+val.cartid+',\'qtyupd\','+val.unitprodprice+')" type="button" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>';
					cart+= '    <button onclick="updatecart('+val.cartid+',\'remcart\',\'\')" type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>';
					cart+= '   </span>';
					cart+= '  </div>';
					cart+= ' </td>';
					cart+= ' <td>Rs. '+val.unitprodprice+'</td>';
					cart+= ' <td>Rs. '+val.totprodprice+'</td>';
					cart+= '</tr>';
					$("#tblcartbody").append(cart);
				});
				$("#cartjstot").html('<h4>Rs. '+data.total+'</h4>');
			}
			else{

			}
		},
		error: function(xhr){
			
		}
	});
	//ajax
}
/****** update cartqty *******/

/***** remove myaccount address *****/
function removeaddres(id){
	confirmModal("Are you sure you want to delete this address?",function(){
		if (result) {
			console.log("ok");
			$.ajax({
				url : siteURL+"scripts.php",
				type : "post",
				data : {action:'removeaddress',addrid:id},
				beforeSend: function(){	
					$("#load-txt").html("<i class='fa fa-spinner fa-pulse fa-fw'></i>&nbsp;&nbsp;Please wait...");			
					$("#loaderModal").modal();
				},
				success: function(response){
					if(response == "1"){
						$("#loaderModal").modal('hide');
						$("#result-txt").html("Address removed...");
						$("#resultModal").modal();
						setTimeout(function(){ window.location.href=siteURL+'account/addresses'; }, 2000);
					}
					else{
						$("#loaderModal").modal('hide');
						$("#result-txt").html("Error try again...");
						$("#resultModal").modal();
					}
				},
				error: function(xhr){
					$("#loaderModal").modal('hide');
					$("#result-txt").html("Error try again...");
					$("#resultModal").modal();
				}
			});
		}
	});
}
/***** remove myaccount address *****/

/**** checkout delivery details show & hide *****/
function delv(){
  if($('input#shipping').is(':checked')) {
    $("#shipping-address").slideUp();
    //$("#shipping-address").find('input').val('');  
  }
  else{
    $("#shipping-address").slideDown();
  }
}
/**** checkout delivery details show & hide *****/

/*** scroll to top show error or update *****/
function scrolltoerror(id){
	$('html,body').animate({scrollTop:$('#'+id).offset().top-150}, 600);
}
/*** scroll to top show error or update *****/

/****** validate email ******/
function isValidEmailAddress(emailAddress){
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
/****** validate email ******/

/***** enter number only ******/
function enterNumerics(e){
  if (!e) var e = window.event;
  if(!e.which) key = e.keyCode; 
  else key = e.which; 
  if((key>=48)&&(key<=57)||key==8||key==9){
    key=key;
    return true;
  }
  else{
    key=0;
    return false;
  }  
}
/***** enter number only ******/

/***** boostrap confirm alert ******/
var result='';
function confirmModal(showtxt,callback) {
	$("#sure-txt").html(showtxt);
	var $confirm = $('#yesornoModal');
	$confirm.modal();
	$confirm.unbind("click");
	$confirm.on('click', 'button', function(){
	  $confirm.modal('hide');
		var res=$(this).data("id");
		if(res=='ok'){   
			result=true;
		}
		else{
			result=false;
		}
		callback(result);
  });
}
/***** boostrap confirm alert ******/

/*** searchbar  ****/
function serchbar(txt){
	console.log(txt);
}
/*** searchbar  ****/