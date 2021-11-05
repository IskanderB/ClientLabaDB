<template>
    <div>
        <label>Edit</label>
        <div>
            <ul>
                <li v-for="(value, name) in columns">

                    <label>{{name}}</label>
                    <input v-model="columns[name]">
                </li>
            </ul>
        </div>
        <button @click="edit">Edit</button>
        <div id="message" v-for="message in messages" :style="{color: color}">
            {{message}}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'configData',
        'database',
        'editData'
    ],
    data: function () {
        return {
            columns: this.editData.data,
            messages: null,
            color: 'red'
        }
    },
    methods: {
        edit() {
            let columns = Object.assign({}, this.columns);
            for (const [key, value] of Object.entries(this.columns)) {
                if (value === null || value === '') {
                    delete columns[key];
                }
            }
            axios({
                method: 'put',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/rows/edit',
                data: {
                    name: this.database,
                    data: columns
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
