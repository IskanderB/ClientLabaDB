
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
    </div>
</template>

<script>
export default {
    props: [
        'configData',
        'database',
        'messagesPrint',
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

    }
}
</script>
