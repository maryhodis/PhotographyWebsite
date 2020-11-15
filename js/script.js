// JavaScript Document

$(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        }
        });
    });
    

document.addEventListener('DOMContentLoaded', function() {
    var url ='./';
    $('body').on('click', '.datetimepicker', function() {
        $(this).not('.hasDateTimePicker').datetimepicker({
            controlType: 'select',
            changeMonth: true,
            changeYear: true,
            // dateFormat: 'dd-mm-yy',
            // timeFormat: 'HH:mm:ss',
            yearRange: "2020:+10",
            showOn:'focus',
            firstDay: 1
        }).focus();
    });
        
    $(".colorpicker").colorpicker();
    
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        //uncomment to have a default date
        //defaultDate: '2020-04-07',
        events: url+'api/load.php',
        eventDrop: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            if (arg.event.end == null) {
                end = start;
            } else {
                var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();
            }

            $.ajax({
                url:url+"api/update.php",
                type:"POST",
                data:{id:arg.event.id, start:start, end:end},
            });
        },
        eventResize: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();

            $.ajax({
                url:url+"api/update.php",
                type:"POST",
                data:{id:arg.event.id, start:start, end:end},
            });
        },
        eventClick: function(arg) {
            var id = arg.event.id;
            
            $('#editEventId').val(id);
            $('#deleteEvent').attr('data-id', id); 

            $.ajax({
                url:url+"api/getevent.php",
                type:"POST",
                dataType: 'json',
                data:{id:id},
                success: function(data) {
                    $('#editEventTitle').val(data.title);
                    $('#editStartDate').val(data.start);
                    $('#editEndDate').val(data.end);
                    $('#editColor').val(data.color);
                    $('#editTextColor').val(data.textColor);
                    $('#editeventmodal').modal();
                }
            });

            $('body').on('click', '#deleteEvent', function() {
                if(confirm("Are you sure you want to remove it?")) {
                    $.ajax({
                        url:url+"api/delete.php",
                        type:"POST",
                        data:{id:arg.event.id},
                    }); 

                    //close model
                    $('#editeventmodal').modal('hide');

                    //refresh calendar
                    calendar.refetchEvents();         
                }
            });
            
            calendar.refetchEvents();
        }
    });
        
    calendar.render();

    $('#createEvent').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // process the form
        $.ajax({
            type        : "POST",
            url         : url+'api/insert.php',
            data        : $(this).serialize(),
            dataType    : 'json',
            encode      : true
        }).done(function(data) {

            // insert worked
            if (data.success) {
                
                //remove any form data
                $('#createEvent').trigger("reset");

                //close model
                $('#addeventmodal').modal('hide');

                //refresh calendar
                calendar.refetchEvents();

            } else {

                //if error exists update html
                if (data.errors.date) {
                    $('#date-group').addClass('has-error');
                    $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.title) {
                    $('#title-group').addClass('has-error');
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                }

            }

        });
    });

    $('#editEvent').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        //form data
        var id = $('#editEventId').val();
        var title = $('#editEventTitle').val();
        var start = $('#editStartDate').val();
        var end = $('#editEndDate').val();
        var color = $('#editColor').val();
        var textColor = $('#editTextColor').val();

        // process the form
        $.ajax({
            type        : "POST",
            url         : url+'api/update.php',
            data        : {
                id:id, 
                title:title, 
                start:start,
                end:end,
                color:color,
                text_color:textColor
            },
            dataType    : 'json',
            encode      : true
        }).done(function(data) {

            // insert worked
            if (data.success) {
                
                //remove any form data
                $('#editEvent').trigger("reset");

                //close model
                $('#editeventmodal').modal('hide');

                //refresh calendar
                calendar.refetchEvents();

            } else {

                //if error exists update html
                if (data.errors.date) {
                    $('#date-group').addClass('has-error');
                    $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.title) {
                    $('#title-group').addClass('has-error');
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                }

            }

        });
    });
});
        
    // var calendar = $('#calendar').fullCalendar({
    //     editable:true,
    //     header:{
    //         left:'prev,next today',
    //         center:'title',
    //         right:'agendaWeek, month, agendaDay'
    //     },
    //     defaultView: 'agendaWeek',
    //     allDaySlot: false,
    //     events: './components/load.php',
    //     selectable:true,
    //     selectHelper:true,
    //     select: function(start, end, allDay)
    //     {
    //     var title = prompt("Enter Event Title");
    //     if(title)
    //     {
    //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    //     $.ajax({
    //     url:"./components/insert.php",
    //     type:"POST",
    //     data:{title:title, start:start, end:end},
    //     success:function()
    //     {
    //         calendar.fullCalendar('refetchEvents');
    //         alert("Added Successfully");
    //     }
    //     })
    //     }
    //     },
    //     editable:true,
    //     eventResize:function(event)
    //     {
    //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    //     var title = event.title;
    //     var id = event.id;
    //     $.ajax({
    //     url:"./components/update.php",
    //     type:"POST",
    //     data:{title:title, start:start, end:end, id:id},
    //     success:function(){
    //     calendar.fullCalendar('refetchEvents');
    //     alert('Event Update');
    //     }
    //     })
    //     },
    
    //     eventDrop:function(event)
    //     {
    //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    //     var title = event.title;
    //     var id = event.id;
    //     $.ajax({
    //     url:"./components/update.php",
    //     type:"POST",
    //     data:{title:title, start:start, end:end, id:id},
    //     success:function()
    //     {
    //     calendar.fullCalendar('refetchEvents');
    //     alert("Event Updated");
    //     }
    //     });
    //     },
    
    //     eventClick:function(event)
    //     {
    //     if(confirm("Are you sure you want to remove it?"))
    //     {
    //     var id = event.id;
    //     $.ajax({
    //     url:"./components/delete.php",
    //     type:"POST",
    //     data:{id:id},
    //     success:function()
    //     {
    //         calendar.fullCalendar('refetchEvents');
    //         alert("Event Removed");
    //     }
    //     })
    //     }
    //   },
//   })

document.addEventListener("DOMContentLoaded", function() {
    fields.firstName = document.getElementById('firstName');
    fields.lastName = document.getElementById('lastName');
    fields.email = document.getElementById('email');
    fields.address = document.getElementById('address');
    fields.country = document.getElementById('country');
    fields.password = document.getElementById('password');
    fields.passwordCheck = document.getElementById('passwordCheck');
    fields.question = document.getElementById('question');
});

function isNotEmpty(value) {
    if (value == null || typeof value == 'undefined' ) return false;
    return (value.length > 0);
   }
function isNumber(num) {
return (num.length > 0) && !isNaN(num);
}

function isPasswordValid(password) {
    if (password.length > 5) {
    return true;
    }
    return false
   }
function fieldValidation(field, validationFunction) {
    if (field == null) return false;

    let isFieldValid = validationFunction(field.value)
    if (!isFieldValid) {
        field.className = 'placeholderRed';
    } else {
        field.className = '';
    }

    return isFieldValid;
}
function isValid() {
    var valid = true;
    
    valid &= fieldValidation(fields.firstName, isNotEmpty);
    valid &= fieldValidation(fields.lastName, isNotEmpty);
    valid &= fieldValidation(fields.address, isNotEmpty);
    valid &= fieldValidation(fields.country, isNotEmpty);
    valid &= fieldValidation(fields.email, isEmail);
    valid &= fieldValidation(fields.password, isPasswordValid);
    valid &= fieldValidation(fields.passwordCheck, isPasswordValid);
    valid &= fieldValidation(fields.question, isNotEmpty);
    valid &= arePasswordsEqual();
   
    return valid;
}
function arePasswordsEqual() {
    if (fields.password.value == fields.passwordCheck.value) {
        field.password.className = 'placeholderRed';
        field.passwordCheck.className = 'placeholderRed';
    return true;
    }
    return false;
}
class User {
    constructor(firstName, lastName, address, country, email, question) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.address = address;
    this.country = country;
    this.email = email;
    this.question = question;
    }
}
function sendContact(){
    if (isValid()) {
        let usr = new User(firstName.value, lastName.value, address.value, country.value, email.value);
        
        alert('${usr.firstName} thanks for registrering.')
    } else {
        alert("There was an error.")
    }
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }