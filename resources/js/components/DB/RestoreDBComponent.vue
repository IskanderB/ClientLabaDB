<template>
    <button @click="restore">Restore</button>
</template>

<script>
    export default {
        props: [
            'configData',
            'database',
            'messagesPrint'
        ],
        methods: {
            restore() {
                axios({
                    method: 'put',
                    url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/restore',
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
