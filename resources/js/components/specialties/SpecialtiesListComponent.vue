<template>
    <div class="container">
        <div class="row form-search-specialties">
            <div class="container">
                <div class="card card-small card-specialty-search mb-12">
                    <div class="form-group col-md-11">
                        <input type="text" class="form-control" v-model="searchTherm" id="inputSearch" placeholder="Name" value="">
                    </div>
                    <div class="form-group col-md-1 form-button">
                        <button type="button" class="mb-2 btn btn-sm btn-outline-success mr-1" @click="searchSpecialties()">Buscar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Name</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody ref="options_table" v-for="specialty in specialties" v-bind:key="specialty.id">
                            <tr>
                                <td>{{specialty.name}}
                                    <input type="hidden" name="specialties[]" :value="(specialty.id != undefined ? specialty.id : specialty.id)">
                                </td>
                                <td>
                                    <button type="button" v-on:click="delSpecialty(specialty)" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>

                                    <button type="button" v-on:click="goToEdit(specialty)" class="btn btn-outline-info"><i
                                        class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                specialties: [],
                currentUrl: window.location.pathname,
                searchTherm: null,
                searchUrl: "/api/specialties/name/--searchTherm--/00000000000/0/100"
            }
        },
        mounted() {

            this.getspecialties();

        },
        props: ['route'],
        methods: {
            searchSpecialties: function(){
                var url = this.searchUrl.replace('--searchTherm--', this.searchTherm);

                window.axios.post('api/search', {
                    'name': this.searchTherm
                }).then((res) => {

                    this.specialties = res.data
                });
            },
            getspecialties: function () {
                window.axios.get('api/list').then((res) => {
                    this.specialties = res.data;
                })
            },
            delSpecialty: function(specialty){
                window.axios.delete('../api/specialties/delete/' + specialty.id).then((res) => {
                    toastr.info("Produto deletado com sucesso");
                 
                });
                this.specialties.pop(specialty);
            },
            goToEdit: function(specialty){
                window.location.href = 'edit/'+specialty.id;
            }
        }
    }
</script>

<style>
    .form-search-specialties{
        margin-bottom: 30px;
    }

    .form-button{
        float: right;
    }

    .card.card-small.card-specialties-search.mb-12 {
        display: flex;
        flex-direction: row;
        padding-top: 20px;
    }
    .card.card-small.card-specialties-search.mb-12 .form-group {
        padding-right: 0;
    }

    .card.card-small.card-specialties-search.mb-12 .form-group.form-button{

        padding-left: 3px;

    }
</style>
