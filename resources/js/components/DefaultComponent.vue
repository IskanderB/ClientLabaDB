<template>
    <header class="header">
        <h1 class="heading">What about your <br><b>DataBase</b>?</h1>
        <h2 class="subtitle">Turning your big data into reality</h2>

        <nav class="main-nav">
            <ul class="site-nav">
                <li class="main-nav-item">
                    <div>
                        <label class="choose-database-label"></label>
                        <select id="database" class="choose-database" @change="handleSelectItem" v-model="selectedItem">
                            <option class="choose-option">{{selectedItem}}</option>
                            <option class="choose-option" v-for="database in databases">
                                {{database}}
                            </option>
                        </select>
                    </div>
                </li>
                <li class="main-nav-item">
                    <button @click="changeComponentDefault('CreateDBComponent')">
                        Create DataBase
                    </button>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    data: function () {
        return {
            databases: [],
            selectedItem: 'Choose DB',
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
