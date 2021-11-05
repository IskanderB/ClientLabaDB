<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TOTAL DB Component</div>
                    <div style="font-weight:bold">{{database}}</div>
                    <div class="card-body">
                        <SelectDBComponent :database="database" :messages-print="messagesPrint"
                                           :config-data="configData" :get-select-result="getSelectResult">
                        </SelectDBComponent>
                    </div>
                    <div id="message" v-for="message in messages" :style="{color: color}">
                        {{message}}
                    </div>
                    <table border="1" :style="{display: display}">
                        <tr>
                            <th v-for="(value, name) in columns">{{name}}</th>
                        </tr>
                        <tr v-for="(value, name) in this.result">
                            <td v-for="(value, name) in value.data">
                                {{value}}
                            </td>
                        </tr>
                    </table>
                    <br>
                    <ClearDBComponent :database="database" :messages-print="messagesPrint" :config-data="configData"></ClearDBComponent>
                    <RemoveDBComponent :database="database" :messages-print="messagesPrint" :config-data="configData"></RemoveDBComponent>
                    <BackUpDBComponent :database="database" :messages-print="messagesPrint" :config-data="configData"></BackUpDBComponent>
                    <RestoreDBComponent :database="database" :messages-print="messagesPrint" :config-data="configData"></RestoreDBComponent>
                    <ImportDBComponent :database="database" :messages-print="messagesPrint" :config-data="configData"></ImportDBComponent>
                    <br><br>
                    <button @click="changeComponentTotal('InsertDBComponent')">Insert</button>
                    <button>Edit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClearDBComponent from "./DB/ClearDBConponent";
import RemoveDBComponent from "./DB/RemoveDBComponent";
import BackUpDBComponent from "./DB/BackUpDBComponent";
import RestoreDBComponent from "./DB/RestoreDBComponent";
import ImportDBComponent from "./DB/ImportDBComponent";
import SelectDBComponent from "./Rows/SelectDBComponent";
export default {
    components: {
        ClearDBComponent,
        RemoveDBComponent,
        BackUpDBComponent,
        RestoreDBComponent,
        ImportDBComponent,
        SelectDBComponent,
    },
    props: [
        'changeComponent',
        'configData',
        'database',
    ],
    data: function () {
        return {
            columns: null,
            color: 'red',
            result: null,
            display: 'none',
            messages: []
        }
    },
    methods: {
        getSelectResult(columns, result, display = "") {
            this.columns = columns;
            this.result = result;
            this.display = display;
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
        },
        changeComponentTotal(component) {
            this.changeComponent(component);
        }
    }
}
</script>

