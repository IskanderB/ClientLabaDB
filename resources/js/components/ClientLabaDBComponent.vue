<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Base Component</div>

                    <div class="card-body">
                        <component class="tab"
                            v-bind:is="component"
                            :config-data="this.configData"
                            :choose-d-b="chooseDB"
                            :change-component="changeComponent"
                            :set-edit-data="setEditData"
                            :database="database"
                            :edit-data="editData"
                            :last-component="lastComponent"
                        ></component>
                    </div>
                </div>
                <br><br><br>
                <button @click="changeComponent(lastComponent)">Back</button>
            </div>
        </div>
    </div>
</template>

<script>
    import DefaultComponent from "./DefaultComponent";
    import CreateDBComponent from "./CreateDBComponent";
    import TotalDBComponent from "./TotalDBComponent";
    import InsertDBComponent from "./Rows/InsertDBComponent";
    import SelectForEditDBComponent from "./Rows/SelectForEditDBComponent";
    import EditDBComponent from "./Rows/EditDBComponent";
    export default {
        components: {
            DefaultComponent,
            CreateDBComponent,
            TotalDBComponent,
            InsertDBComponent,
            SelectForEditDBComponent,
            EditDBComponent,
        },
        props: [
            'configData'
        ],
        data: function () {
            return {
                component: 'DefaultComponent',
                database: null,
                editData: null,
                lastComponent: 'DefaultComponent',
            }
        },
        methods: {
            chooseDB(database) {
                this.database = database;
            },
            changeComponent(componentName) {
                this.lastComponent = this.component;
                this.component = componentName;
            },
            setEditData(data) {
                this.editData = data;
            }
        }
    }
</script>
