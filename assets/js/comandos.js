
$(function(){
	
	$(document.body).on('click', '.changeType' ,function(){
		$(this).closest('.phone-input').find('.type-text').text($(this).text());
		$(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
	});
	
	$(document.body).on('click', '.btn-remove-phone' ,function(){
		$(this).closest('.phone-input').remove();
	});
	
	
	$('.btn-add-phone').click(function(){

		var index = $('.phone-input').length + 1;
		
		$('.phone-list').append(''+
				'<div class="input-group phone-input">'+
					'<span class="input-group-btn">'+
						'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="type-text">Type</span> <span class="caret"></span></button>'+
						'<ul class="dropdown-menu" role="menu">'+
							'<li><a class="changeType" href="javascript:;" data-type-value="phone">Phone</a></li>'+
							'<li><a class="changeType" href="javascript:;" data-type-value="fax">Fax</a></li>'+
							'<li><a class="changeType" href="javascript:;" data-type-value="mobile">Mobile</a></li>'+
						'</ul>'+
					'</span>'+
					'<input type="text" name="phone['+index+'][number]" class="form-control" placeholder="+1 (999) 999 9999" />'+
					'<input type="hidden" name="phone['+index+'][type]" class="type-input" value="" />'+
					'<span class="input-group-btn">'+
						'<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
					'</span>'+
				'</div>'
		);

	});
	
});

$(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});