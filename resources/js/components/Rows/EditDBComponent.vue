<template>
<!--    <div>-->
<!--        <label>Edit</label>-->
<!--        <div>-->
<!--            <ul>-->
<!--                <li v-for="(value, name) in columns">-->

<!--                    <label>{{name}}</label>-->
<!--                    <input v-model="columns[name]">-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button @click="edit">Edit</button>-->
<!--        <div id="message" v-for="message in messages" :style="{color: color}">-->
<!--            {{message}}-->
<!--        </div>-->
<!--    </div>-->
    <div class="page-edit-values">
        <h1 class="heading-edit">Change values</h1>
        <h2 class="subtitle-edit">You can add rows to the table, filling them with values</h2>

        <ul class="edit-nav">
            <li v-for="(value, name) in columns" class="edit-nav-item"> {{name}}
                <input type="text" v-model="columns[name]" class="edit-nav-input" v-if="unique[name]" readonly style="background-color: #E5E5E5;">
                <input type="text" v-model="columns[name]" class="edit-nav-input" v-else>
            </li>
        </ul>
        <button @click="edit" class="button-edit-it">
            Edit it!
        </button>

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
        'editData'
    ],
    data: function () {
        return {
            columns: this.editData.data,
            messages: null,
            color: 'red',
            unique: null,
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
                let unique = JSON.parse(response.data.data);
                this.unique = new Object();
                for (let item of unique) {
                    this.unique[item] = true;
                }
                // for (const [key, value] of Object.entries(this.columns)) {
                //     this.unique[key] = this.unique[key] ?? false;
                //     // if (!this.unique[key] ?? false) {
                //     //     this.unique[key] = false;
                //     // }
                // }
                // console.log(this.unique);
            });
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
