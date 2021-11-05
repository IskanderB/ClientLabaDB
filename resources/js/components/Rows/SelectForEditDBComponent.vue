<template>
    <div>
        <label>Select</label>
        <div>
            <select v-model="column">
                <option v-for="item in columns">{{item}}</option>
            </select>
            <input v-model="value">
        </div>
        <button @click="select">Edit</button>
        <div v-for="message in messages" :style="{color: color}">
            {{message}}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'configData',
        'database',
        'changeComponent',
        'setEditData'
    ],
    data: function () {
        return {
            columns: null,
            value: null,
            column: null,
            messages: null,
            color: 'red'
        }
    },
    created() {
        axios({
            method: 'get',
            url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/columns/unique/list',
            params: {
                name: this.database
            }
        })
            .then((response) => {
                let columns = JSON.parse(response.data.data);
                this.columns = columns;
                this.column = this.columns[0];
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
                        this.setEditData(response.data.data[0]);
                        this.changeComponent('EditDBComponent');
                    }
                    else {
                        this.messagesPrint(response.data.message);
                    }
                });
        },
        messagesPrint(messages, color = 'red') {
            this.color = color;
            this.messages = [];
            if (typeof messages == 'string') {
                this.messages.push(messages);
                return null;
            }
            for (const [key, value] of Object.entries(messages)) {
                if (typeof value == 'string') {
                    this.messages.push(value);
                    continue;
                }
                for (let message of value) {
                    this.messages.push(message);
                }
            }
        }
    }
}
</script>
