const { default: axios } = require('axios');

require('./bootstrap');

const message_el = document.getElementById('messages');
const lecture_id_input = document.getElementById('lecture_id');
const student_id_input = document.getElementById('student_id');
const message_input = document.getElementById('message');
const message_form = document.getElementById('message_form');

message_form.addEventListener('submit' , function (e){
    e.preventDefault();

    let has_errors = false ;

    if(message_input.value == '')
    {
        alert('الرجاء كتابة الرسالة');
        has_errors = true;
    }

    if(has_errors)
    {
        return;
    }

    const option = {
        method:'post',
        URL:'/comment-chat',
        date: {
            lecture_id: lecture_id_input.value,
            student_id: student_id_input.value,
            message: message_input.value
        }
    }

    axios(option);
})

        window.Echo.channel('send')
            .listen('.chat', (e)=> 
            {
                console.log(e);
            })


            