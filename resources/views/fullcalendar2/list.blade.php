
<script>
    $(document).ready(function () {
        // let stock = $('.fc-event-container').find('.fc-title').text()

        // $('.fc-content:has(span:contains("task"))').closest('.fc-event-container').addClass('stock-event');

        // $(function(){
        //     $(".event-delete").click(function(){
        //         $(".fc-content:contains('在庫：')").each(function(){
        //             var a = $(this).text();
        //             $(this).closest('.fc-event-container').addClass('stock-event')
        //             console.log(a);
        //         });
        //     });
        // });

        // jQuery('span:contains("在庫")').closest('.fc-content').addClass('sponz');
        // if (stock === '在庫') {
        //     $('div.fc-content').addClass('stock-event')
        // }
        let SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let calendar = $('.js-calendar').fullCalendar({
            editable: true,
            // events: [ SITEURL + "/fullcalendareventmaster", SITEURL + "/reservation"],
            events: SITEURL + "/fullcalendareventmaster",
            eventLimit: 2,
            dayMaxEventRows: 2,
            dayMaxEvents: 2,
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            eventMouseover: function(e, $e) {
                // Get Event id
                console.log(e.id);

                // Add 「stock-event」class
                let hasStock = $(".fc-content:contains('在庫：')");
                $(hasStock).each(function(){
                    $(this).closest('.fc-event-container').addClass('stock-event')
                });
            },
            select: function (start, end, allDay) {
                let title = prompt('Event Title:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: SITEURL + "/fullcalendareventmaster/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true
                    );
                }
                calendar.fullCalendar('unselect');
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: SITEURL + '/fullcalendareventmaster/update',
                    // data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                    data: {
                        title: event.title,
                        start: start,
                        end: end,
                        id: event.id,
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Updated Successfully");
                    }
                });
            },
            eventClick: function (calEvent) {
                if (calEvent.title >= '在庫：') {
                    let stock_id = (calEvent.id);
                    $.get(SITEURL + '/fullcalendareventmaster/get-data/' + stock_id, function (data) {
                        // $('#userCrudModal').html("Edit User");
                        // $('#ajax-crud-modal').modal('show');
                        // $('#stock_form').addClass('update-form');
                        // $('form').attr('id', 'update-form');
                        $('.stock-form').attr({id: 'update-form',  action: '/fullcalendareventmaster/stock-update'});
                        $('#stock_id').val(data.id);
                        $('#stock_number').val(data.title);
                        $('#stock_btn').val("update").text('更新');
                    })
                    $('.event-update').show()
                }
                console.log(calEvent.id)

                // let hasStock = $(".fc-content:contains('在庫：')");
                // Add 「stock-event」class
                //     $(hasStock).each(function(){
                //         $(this).closest('.fc-event-container').addClass('stock-event')
                //     });

                // double clickで開く
                // $(".stock-event").on("click", function () {
                //     $('.event-update').show()
                //
                //
                // })
                // }
                // if ($('.fc-event-container').hasClass('stock-event')) {
                // if ($('.fc-event-container .stock-event')) {
                //     $('.event-update').show()
                // } else {
                //     $('.event-update').hide()
                // }

                // let stock = $('.fc-event-container').find('.fc-title').text('在庫')
                // if (stock) {
                // $('.event-update').show()



                // let deleteMsg = confirm("Do you really want to delete?");
                // if (deleteMsg) {
                //     $.ajax({
                //         type: "POST",
                //         url: SITEURL + '/fullcalendareventmaster/delete',
                //         data: "&id=" + event.id,
                //         success: function (response) {
                //             if(parseInt(response) > 0) {
                //                 $('.js-calendar').fullCalendar('removeEvents', event.id);
                //                 displayMessage("Deleted Successfully");
                //             }
                //         }
                //     });
                // }

            }
        });



        // let stock = $('.fc-event-container').find('.fc-title').text('在庫')
        // if (stock) {
            $("span.fc-title").on("click", function () {
                $('.event-update').show()
                // console.log(stock)
            })
        // }

        // $(function(){
        //     $(window).on('load', function(){
        //         $(".fc-content:contains('在庫')").each(function(){
        //             var a = $(this).text();
        //             $(this).closest('.fc-event-container').addClass('stock-event')
        //             console.log(a);
        //         });
        //     });
        // });

    });

    $(function(){
        $(".close-event").on("click", function () {
            $('.event-update').hide()
        })
    });

    $('#update-form').on('submit', function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: SITEURL + '/fullcalendareventmaster/stock-update',
            type: "POST",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                // $('#option_update').attr('disabled', false);
            },
            success: function (data)
            {
                if(data.error) {
                    let error_html = '';
                    for(let count = 0; count < data.error.length; count++) {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                } else {
                    // $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                    window.location.reload();
                    displayMessage("Updated Successfully");
                }

                // $('#option_update').attr('disabled', false);
            },
            error: function (data) {
                console.log('Error:', data);
                $('#stock_btn').html('Save Changes');
            }
        })
    })

    $(".event-delete").on("click", function () {
        let deleteMsg = confirm("Do you really want to delete?");
        // if (deleteMsg) {
        //     $.ajax({
        //         type: "POST",
        //         url: SITEURL + '/fullcalendareventmaster/delete',
        //         data: "&id=" + event.id,
        //         success: function (response) {
        //             if (parseInt(response) > 0) {
        //                 $('.js-calendar').fullCalendar('removeEvents', event.id);
        //                 displayMessage("Deleted Successfully");
        //             }
        //         }
        //     });
        // }
    })

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
</script>
