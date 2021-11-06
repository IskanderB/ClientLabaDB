<template>
<!--    <div>-->
<!--        <label>Insert</label>-->
<!--        <div>-->
<!--            <ul>-->
<!--                <li v-for="(value, name) in columns">-->

<!--                    <label>{{name}}</label>-->
<!--                    <input v-model="columns[name]">-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button @click="insert">Insert</button>-->
<!--        <div id="message" v-for="message in messages" :style="{color: color}">-->
<!--            {{message}}-->
<!--        </div>-->
<!--    </div>-->
    <div class="page-insert">
        <h1 class="heading-insert">Insert something new</h1>
        <h2 class="subtitle-insert">You can add rows to the table, filling them with values</h2>

        <ul class="insert-nav">
            <li class="insert-nav-item" v-for="(value, name) in columns"> {{name}}
                <input v-model="columns[name]" placeholder="enter the value" class="insert-nav-input">
            </li>
        </ul>
        <button @click="insert" class="button-insert-it">
            Insert it!
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
        'database'
    ],
    data: function () {
        return {
            columns: null,
            data: null,
            messages: null,
            color: 'red'
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
                for (const [key, value] of Object.entries(columns)) {
                    this.columns[key] = null;
                }
            });
    },
    methods: {
        insert() {
            let columns = Object.assign({}, this.columns);
            for (const [key, value] of Object.entries(this.columns)) {
                if (value === null) {
                    delete columns[key];
                }
            }
            axios({
                method: 'post',
                url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/rows/insert',
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
