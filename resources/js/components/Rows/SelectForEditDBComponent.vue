<template>
    <div class="edit-div">
        <h1 class="heading-edit">Edit as you like</h1>
        <h2 class="subtitle-edit">You can change the values ​​in the columns of your choice</h2>

        <h3 class="subtitle-edit-name">Test Name of DataBase</h3>

        <div class="text-field-search-edit">
            <select class="text-field-select-edit" v-model="column">
                <option class="select-options-edit" v-for="item in columns">{{item}}</option>
            </select>
            <p class="text-field-edit-block">
                <label class="text-field-search-label">Select *</label>
                <input v-model="value" name="comment" placeholder="Enter the value" class="text-field-search-input">

                <button @click="select" class="button-edit">
                    Edit
                </button>
            </p>
        </div>

        <section class="modal-response">
            <h2 class="visually-hidden">Модальное окно</h2>
            <div>
                <p class="modal-success-error" v-for="message in messages" :style="{color: color}">
                    {{message}}
                </p>
            </div>
        </section>
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
