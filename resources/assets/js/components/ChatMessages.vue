<template>
    <ul class="chat no-style">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <div v-if="user">
                        <a   v-bind:href="'/profil/' + message.user.name"><strong class="primary-font">
                            {{ message.user.name }}
                        </strong></a>
                    </div>
                    <div v-else>
                        <strong>Anonyme</strong>
                    </div>
                </div>
                <div v-if="user.name === message.user.name" class="others-msg">
                    <p style="text-align: right;">
                        {{ message.message }}
                        <p class="date-msg-own">
                            {{  message.created_at }}
                        </p>
                    </p>
                </div>
                <div v-else class="own-msg">
                    <p>
                        {{ message.message }}
                        <p class="date-msg">
                            {{  message.created_at }}
                        </p>
                    </p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages', 'user']
    };
</script>