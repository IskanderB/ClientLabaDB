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
                            :database="database"
                        ></component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DefaultComponent from "./DefaultComponent";
    import CreateDBComponent from "./CreateDBComponent";
    import TotalDBComponent from "./TotalDBComponent";
    import InsertDBComponent from "./Rows/InsertDBComponent";
    export default {
        components: {
            DefaultComponent,
            CreateDBComponent,
            TotalDBComponent,
            InsertDBComponent
        },
        props: [
            'configData'
        ],
        data: function () {
            return {
                component: 'DefaultComponent',
                database: null
            }
        },
        methods: {
            chooseDB(database) {
                this.database = database;
            },
            changeComponent(componentName) {
                this.component = componentName;
            }
        }
    }
</script>
