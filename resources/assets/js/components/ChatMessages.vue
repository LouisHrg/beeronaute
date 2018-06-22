<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <div v-if="!user">
                        <a   v-bind:href="'/profile/' + message.user.name"><strong class="primary-font">
                            {{ message.user.name }}
                        </strong></a>
                    </div>
                    <div v-else>
                        <strong>Anonyme</strong>
                    </div>
                </div>
                <div v-if="user.name === message.user.name" style="background-color: #696969; color: white; border-radius: 5px;">
                        <p style="padding: 10px; text-align: right;">
                            {{ message.message }}
                        </p>
                </div>
                <div v-else style="background-color: #1b4f72; color: white ; border-radius: 5px;">
                    <p style="padding: 10px;">
                        {{ message.message }}
                    </p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages', 'user'],
    };
</script>