<template>
    <div>
        <ul>
            <li v-for="(user, key) in users" :key="key">
                <a href="/chat/room/{{ user.id }}">{{ user.name }}</a>
            </li>
        </ul>
    </div>
</template>


<script>
export default {
    name: "ChatList",
    data() {
        return {
            users: []
        };
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            axios.get("/chat/users").then(response => {
                this.users = response.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
