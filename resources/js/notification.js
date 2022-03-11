import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.private('App.Models.User.' + userId).notification(function (message) {
    var dom = document.createElement('div');
    dom.innerHTML = `
<a href="${message.url}" class="dropdown-item">
    <i class="fas fa-envelope mr-2"></i>
${message.title}
<span
    class="float-right text-muted text-sm">now</span>
</a>
`;
document.getElementById("list").prepend(dom);


    var x = document.getElementById("notificationNum").innerHTML;
    document.getElementById("notificationNum").innerHTML = parseInt(x) + 1;
    $(document).Toasts('create', {
        title: message.title,
        body: message.body
    });
    // $('.toastMessage').b
    // alert(message.title);
});