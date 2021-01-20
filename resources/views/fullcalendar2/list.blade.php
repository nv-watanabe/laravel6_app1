<script>
    $(document).ready(function () {
        let SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL + "/fullcalendareventmaster",
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
            select: function (start, end, allDay) {
                let title = prompt('Event Title:');
                if (title) {
                    let start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    let end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
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
                let start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                let end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
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
            eventClick: function (event) {
                let deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/fullcalendareventmaster/delete',
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                }
            }
        });
    });
    // function displayMessage(message) {
    //     $(".response").html(message);
    //     setInterval(function() { $(".success").fadeOut(); }, 1000);
    // }

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
</script>
