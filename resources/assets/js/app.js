require('./bootstrap');

window.Vue = require('vue');

let autoScroll = () => {
    $(".panel-body").scrollTop($(".panel-body").prop("scrollHeight"));
};

var token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

let app = new Vue({
    moment: moment,
    el: '#app',

    data: {
        messages: [],
        eventid: ''
    },

    created() {
        $(".panel-body").scrollTop($(".panel-body").prop("scrollHeight"))
    },

    mounted() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

    methods: {

        fetchMessages() {
            axios.get('/chat/messages/'+this.eventid).then(response => {
                this.messages = response.data;
            });
            autoScroll();
        },

        addMessage(message) {
            this.messages.push(message);
            axios.post('/chat/messages', message).then(response => {
                console.log(response.data)
                autoScroll();
            });
        }
    }
});

$(document).ready(() => {
    autoScroll();
})
