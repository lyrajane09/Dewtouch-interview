<style>
	.no-border{
		border: none;
	    width: 0;
	    height: 0!important;
	    opacity: 0;
	}
	.disable-input{
		border: 0;
    	background: #f9f9f9;
	}
</style>
<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
	<tr>
	<td></td>
	<td class="column"><textarea name="data[1][description]" class="m-wrap  description required no-border textarea" rows="2"></textarea></td>
	<td class="column"><input name="data[1][quantity]" class="no-border texinput"></td>
	<td class="column"><input name="data[1][unit_price]"  class="no-border texinput"></td>
	
</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>



<script>
$(document).ready(function(){

	$("#add_item_button").click(function(){
		
		var total = $('.table tbody tr').length + 1;		

		var append = '<tr>';
		append += '<td></td>';
		append += '<td class="column"><textarea name="data[total][description]" class="m-wrap  description required no-border textarea" rows="2"></textarea></td>';
		append += '<td class="column"><input name="data[total][quantity]" class="no-border texinput"></td>';
		append += '<td class="column"><input name="data[total][unit_price]"  class="no-border texinput"></td>';
		append += '<tr/>';

		$('.table tbody').append(append);

		$('.column').on('click', function(){
			$.each($('.texinput'), function(){
				if($(this).val() != ''){
					$(this).removeClass('no-border');
					$(this).addClass('disable-input');
				}else{
					$(this).addClass('no-border');
					$(this).removeClass('disable-input');
				}
			});

			$.each($('.textarea'), function(){
				if($(this).val() != ''){
					$(this).removeClass('no-border');
					$(this).addClass('disable-input');
				}else{
					$(this).addClass('no-border');
					$(this).removeClass('disable-input');
				}
			});

			$(this).find('.no-border').removeClass('no-border');
			$(this).find('.disable-input').removeClass('disable-input');
			
		});

	});

	$('.column').on('click', function(){
		$.each($('.texinput'), function(){
			if($(this).val() != ''){
				$(this).removeClass('no-border');
				$(this).addClass('disable-input');
			}else{
				$(this).addClass('no-border');
				$(this).removeClass('disable-input');
			}
		});

		$.each($('.textarea'), function(){
			if($(this).val() != ''){
				$(this).removeClass('no-border');
				$(this).addClass('disable-input');
			}else{
				$(this).addClass('no-border');
				$(this).removeClass('disable-input');
			}
		});

		$(this).find('.no-border').removeClass('no-border');
		$(this).find('.disable-input').removeClass('disable-input');
		
	});


	$('.texinput, .textarea').on('focus', function(){
		if($(this).val() != ''){
			$(this).removeClass('not-empty');
			$(this).removeClass('no-border');
			$(this).removeClass('disable-input');
		}
	});

	$('.column').on('focusout', function(){
		
		$(this).find('.textrea').addClass('no-border');
		$(this).find('.texinput').addClass('no-border');
		$(this).find('.textarea').addClass('disable-input');
		$(this).find('.texinput').addClass('disable-input');
		
	});

	
});
</script>
<?php $this->end();?>

