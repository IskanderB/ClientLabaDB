<template>
    <button @click="importDB">Import</button>
</template>

<script>
export default {
    props: [
        'configData',
        'database',
        'messagesPrint'
    ],
    methods: {
        importDB() {
            axios({
                method: 'get',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/import',
                params: {
                    name: this.database
                }
            })
                .then((response) => {
                    let messages = response.data.message;
                    if (response.data.success) {
                        this.messagesPrint([messages, response.data.data.importFilePath], 'green');
                    }
                    else {
                        this.messagesPrint(messages);
                    }
                });
        }
    }
}
</script>
