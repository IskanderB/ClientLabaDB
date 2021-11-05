<template>
    <div>
        <label>Select</label>
        <div>
            <select v-model="column">
                <option v-for="(value, name) in columns">{{name}}</option>
            </select>
            <input v-model="value">
        </div>
        <button @click="select">Select</button>
        <button @click="deleteRow">Delete</button>
    </div>
</template>

<script>
export default {
    props: [
        'configData',
        'database',
        'messagesPrint',
        'getSelectResult'
    ],
    data: function () {
        return {
            columns: null,
            value: null,
            column: null
        }
    },
    created() {
        axios({
            method: 'get',
            url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/columns/list',
            params: {
                name: this.database
            }
        })
            .then((response) => {
                let columns = JSON.parse(response.data.data);
                this.columns = columns;
                this.column = Object.keys(this.columns)[0];
            });
    },
    methods: {
        select() {
            this.result = null;
            axios({
                method: 'post',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/rows/select',
                data: {
                    name: this.database,
                    data: {
                        name: this.column,
                        value: this.value
                    }
                }
            })
                .then((response) => {
                    if (response.data.success) {
                        this.messagesPrint(response.data.message, 'green');
                    }
                    else {
                        this.messagesPrint(response.data.message);
                    }

                    if (response.data.success) {
                        this.getSelectResult(this.columns, response.data.data);
                    }
                    else {
                        this.getSelectResult([], [], 'none');
                    }
                });
        },
        deleteRow() {
            this.getSelectResult([], [], 'none');
            axios({
                method: 'delete',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/rows/delete',
                data: {
                    name: this.database,
                    data: {
                        name: this.column,
                        value: this.value
                    }
                }
            })
                .then((response) => {
                    if (response.data.success) {
                        this.messagesPrint(response.data.message, 'green');
                    }
                    else {
                        this.messagesPrint(response.data.message);
                    }
                });
        }
    }
}
</script>
