<template>
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Create Component</div>-->
<!--                    <div>-->
<!--                        <label>Name:</label>-->
<!--                        <input v-model="name">-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <ul>-->
<!--                            <li v-bind:id="`${name}`" v-for="(value, name) in columns">-->
<!--                                <label>{{name}}</label>-->
<!--                                <div>-->
<!--                                    <select v-model="columns[name].type">-->
<!--                                        <option>integer</option>-->
<!--                                        <option>string</option>-->
<!--                                        <option>numeric</option>-->
<!--                                        <option>boolean</option>-->
<!--                                    </select>-->
<!--                                    <select v-model="columns[name].unique">-->
<!--                                        <option>not unique</option>-->
<!--                                        <option>unique</option>-->
<!--                                    </select>-->
<!--                                    <input v-model="columns[name].name">-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                        <button @click="create">Create</button>-->
<!--                    </div>-->
<!--                    <div id="message" v-for="message in messages" :style="{color: color}">-->
<!--                        {{message}}-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
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

<!--                    <li class="create-nav-item">Column_2-->
<!--                        <select class="create-select">-->
<!--                            <option>integer</option>-->
<!--                            <option>char</option>-->
<!--                            <option>float</option>-->
<!--                            <option>string</option>-->
<!--                            <option>date</option>-->
<!--                        </select>-->
<!--                        <select class="create-select">-->
<!--                            <option>unique</option>-->
<!--                            <option>not unique</option>-->
<!--                        </select class="create-select">-->
<!--                        <input type="name" placeholder="name" class="create-select">-->
<!--                    </li>-->

<!--                    <li class="create-nav-item">Column_3-->
<!--                        <select class="create-select">-->
<!--                            <option>integer</option>-->
<!--                            <option>char</option>-->
<!--                            <option>float</option>-->
<!--                            <option>string</option>-->
<!--                            <option>date</option>-->
<!--                        </select>-->
<!--                        <select class="create-select">-->
<!--                            <option>unique</option>-->
<!--                            <option>not unique</option>-->
<!--                        </select>-->
<!--                        <input type="name" placeholder="name"  class="create-select">-->
<!--                    </li>-->

<!--                    <li class="create-nav-item">Column_4-->
<!--                        <select class="create-select">-->
<!--                            <option>integer</option>-->
<!--                            <option>char</option>-->
<!--                            <option>float</option>-->
<!--                            <option>string</option>-->
<!--                            <option>date</option>-->
<!--                        </select>-->
<!--                        <select class="create-select">-->
<!--                            <option>unique</option>-->
<!--                            <option>not unique</option>-->
<!--                        </select>-->
<!--                        <input type="name" placeholder="name" class="create-select">-->
<!--                    </li>-->

                </ul>
                <button type="submit" class="button-create" @click="create">
                    Create it!
                </button>
                </p>
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
