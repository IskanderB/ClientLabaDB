<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Base Component</div>

                    <div class="card-body">
                        <component v-bind:is="component" :config-data="this.configData" class="tab"></component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import CreateDBComponent from './CreateDBComponent.vue';
    export default {
        // components: {
        //     CreateDBComponent
        // },
        props: [
            'configData'
        ],
        data: function () {
            return {
                components: {
                    'default': 'default-component',
                    'create': 'create-component'
                },
                component: 'default-component'
            }
        },
        mounted() {
            // console.log(this.components);

        },
    }
</script>
