    $(document).ready(function() {
alert("here");
        var iCnt = 0;
        // CREATE A "tr" ELEMENT AND DESIGN IT USING JQUERY ".css()" CLASS.
        /*var container = $(document.createElement('tr')).css({
            padding: '5px', margin: '20px', width: '170px', border: '1px dashed',
            borderTopColor: '#999', borderBottomColor: '#999',
            borderLeftColor: '#999', borderRightColor: '#999'
        });*/
		 

        $('#btAdd').click(function() {
            if (iCnt <= 5) {

                iCnt = iCnt + 1;

                // ADD LINE ITEM.
				 $(".qitems").append('<tr><td><select name="qproduct" id=qproduct' + iCnt + ' ' + '><option value="one">One</option></select></td><td><input type="text" name="reward_amount" id=reward_amount' + iCnt + ' ' + ' value=""></td><td><input type="button" id=btRemove' + iCnt + ' ' + ' name="remove" value="Remove"></td></tr>');			});
				
				//$(container).append('<input type=text class="input" id=tb' + iCnt + ' ' + ' />');

                // SHOW SUBMIT BUTTON IF ATLEAST "1" ELEMENT HAS BEEN CREATED.
                if (iCnt == 1) {

                    var divSubmit = $(document.createElement('div'));
                    $(divSubmit).append('<input type=button class="bt" 
                        onclick="GetTextValue()"' + 
                            'id=btSubmit value=Submit />');

                }

                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#main').after(container, divSubmit);
            }
            // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON.
            // (20 IS THE LIMIT WE HAVE SET)
            else {      
                $(container).append('<label>Reached the limit</label>'); 
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');
            }
        });

        // REMOVE ELEMENTS ONE PER CLICK.
        $('#btRemove').click(function() {
            if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }
        
            if (iCnt == 0) { 
                $(container).
                    .empty() 
                    .remove(); 

                $('#btSubmit').remove(); 
                $('#btAdd')
                    .removeAttr('disabled') 
                    .attr('class', 'bt') 

            }
        });
    });

    // PICK THE VALUES FROM EACH TEXTBOX WHEN "SUBMIT" BUTTON IS CLICKED.
    var divValue, values = '';

    function GetTextValue() {

        $(divValue) 
            .empty() 
            .remove(); 
        
        values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);
    }