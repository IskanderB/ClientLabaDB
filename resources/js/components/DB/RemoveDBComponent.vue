<template>
    <button @click="remove">Remove</button>
</template>

<script>
    export default {
        props: [
            'configData',
            'database',
            'messagesPrint'
        ],
        methods: {
            remove() {
                axios({
                    method: 'delete',
                    url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/remove',
                    data: {
                        name: this.database
                    }
                })
                    .then((response) => {
                        let messages = response.data.message;
                        if (response.data.success) {
                            this.messagesPrint(messages, 'green');
                        }
                        else {
                            this.messagesPrint(messages);
                        }
                    });
            }
        }
    }
</script>
