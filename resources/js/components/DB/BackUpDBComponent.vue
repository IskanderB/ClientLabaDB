<template>
    <button @click="backUp">BackUp</button>
</template>

<script>
    export default {
        props: [
            'configData',
            'database',
            'messagesPrint'
        ],
        methods: {
            backUp() {
                axios({
                    method: 'put',
                    url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/backup',
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
                        // this.columns = columns;
                        // this.column = Object.keys(this.columns)[0];
                    });
            }
        }
    }
</script>
