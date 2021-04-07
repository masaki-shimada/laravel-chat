<template>
    <div>
        <ul>
            <li v-for="(message, key) in messages" :key="key">
                <strong>{{ message.user.name }}</strong>
                {{ message.message }}
            </li>
        </ul>
        <input v-model="text" />
        <button @click="postMessage" :disabled="!textExists">送信</button>
    </div>
</template>

<script>
import Pusher from "pusher-js";

export default {
    data() {
        return {
            channel: null,
            text: "",
            messages: []
        };
    },
    computed: {
        textExists() {
            return this.text.length > 0;
            //this.fetchMessages();
        }
    },
    mounted() {
        this.fetchMessages();

        Echo.private("chat").listen("MessageSent", e => {
            this.messages.push({
                message: e.message.message,
                user: e.user
            });
        });

    },
    methods: {
        getPusherInstance() {
            return new Pusher(this.pusherKey, {
                authEndpoint: '/auth/video_chat',
                cluster: this.pusherCluster,
                auth: {
                    headers: {
                        'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content
                    }
                }
            });
        },
        fetchMessages() {
            axios.get("/chat/messages").then(response => {
                this.messages = response.data;
            });
        },
        postMessage(message) {
            axios.post("/chat/messages", { message: this.text }).then(response => {
                this.text = "";
                //this.fetchMessages();
            });
        }
    }
};
</script>
