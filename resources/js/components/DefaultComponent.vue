<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Default Component</div>
                    <div class="form-section">
                        <select id="database" @change="handleSelectItem" v-model="selectedItem">
                            <option>Choose DB</option>
                            <option v-for="database in databases">
                                {{database}}
                            </option>
                        </select>
                        <button v-on:click="changeComponentDefault('CreateDBComponent')">Create DB</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            databases: [],
            selectedItem: "Choose DB",
        }
    },
    props: [
        'configData',
        'chooseDB',
        'changeComponent'
    ],
    created() {
        axios({
            method: 'get',
            url: this.configData.appUrl + '/api/' + this.configData.apiVersion + '/db/list',
        })
            .then((response) => {
                let databases = JSON.parse(response.data.data);
                this.databases = databases;
            });
    },
    methods: {
        handleSelectItem: function (){
            this.chooseDB(this.selectedItem);
            this.changeComponentDefault('TotalDBComponent');
        },
        changeComponentDefault(component) {
            this.changeComponent(component);
        }
    }
}
</script>
