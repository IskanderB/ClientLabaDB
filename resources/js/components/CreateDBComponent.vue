<template>
    <div class="container">
        <h1 class="heading-create">Let's create your own DataBase</h1>
        <h2 class="subtitle-create">You can manage, make changes and delete your database</h2>

        <div action="" method="post" class="">
            <div class="text-field-create">
                <p class="text-field-create-block">
                    <label for="create" class="text-field-create-label">Enter the name *</label>
                    <input id="create" type="search" v-model="name" placeholder="Name of database" class="text-field-create-input">
                <ul class="create-nav">

                    <li class="create-nav-item" v-bind:id="`${name}`" v-for="(value, name) in columns">{{name}}
                        <select class="create-select" v-model="columns[name].type">
                            <option>integer</option>
                            <option>string</option>
                            <option>numeric</option>
                            <option>boolean</option>
                        </select>
                        <select class="create-select" v-model="columns[name].unique">
                            <option>not unique</option>
                            <option>unique</option>
                        </select>
                        <input type="name" placeholder="name" class="create-select" v-model="columns[name].name">
                    </li>
                </ul>
                <button type="submit" class="button-create" @click="create">
                    Create it!
                </button>
                </p>
                <section class="modal-response">
                    <h2 class="visually-hidden">Модальное окно</h2>
                    <div>
                        <p class="modal-success-error" v-for="message in messages" :style="{color: color}">
                            {{message}}
                        </p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'configData'
    ],
    data: function (){
        return {
            name: null,
            columns: {
                column_1 : {
                    type: 'integer',
                    unique: 'not unique',
                    name: null
                },
                column_2 : {
                    type: 'integer',
                    unique: 'not unique',
                    name: null
                },
                column_3 : {
                    type: 'integer',
                    unique: 'not unique',
                    name: null
                },
                column_4 : {
                    type: 'integer',
                    unique: 'not unique',
                    name: null
                }
            },
            messages: [],
            color: 'red'
        }
    },
    methods: {
        create() {
            this.messages = [];
            this.transformData();
            axios({
                method: 'post',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/create',
                data: {
                    name: this.name,
                    column_1: this.columns.column_1,
                    column_2: this.columns.column_2,
                    column_3: this.columns.column_3,
                    column_4: this.columns.column_4
                }
            })
                .then((response) => {
                    if (response.data.success) {
                        this.color = 'green';
                    }
                    this.messagesPrint(response.data.message);
                });
        },
        messagesPrint(messages) {
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
        },
        transformData() {
            for (const [key, value] of Object.entries(this.columns)) {
                if (this.columns[key].unique === 'unique') {
                    this.columns[key].unique = true;
                }
                else {
                    this.columns[key].unique = false;
                }
            }
        }
    }
}
</script>
