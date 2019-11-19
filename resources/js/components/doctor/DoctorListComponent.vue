<template>
    <div class="container">
        <div class="row form-search-doctors">
            <div class="container">
                <div class="card card-small card-doctor-search mb-12">
                    <div class="form-group col-md-11">
                        <input type="text" class="form-control" v-model="searchTherm" id="inputSearch" placeholder="Name" value="">
                    </div>
                    <div class="form-group col-md-1 form-button">
                        <button type="button" class="mb-2 btn btn-sm btn-outline-success mr-1" @click="searchDoctors()">Buscar</button>
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
                                <th scope="col" class="border-0">CRM</th>
                                <th scope="col" class="border-0">Telephone</th>
                                <th scope="col" class="border-0">Specialties</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody ref="options_table" v-for="doctor in doctors" v-bind:key="doctor.id">
                            <tr>
                                <td>{{doctor.name}}
                                    <input type="hidden" name="doctors[]" :value="(doctor.id != undefined ? doctor.id : doctor.id)">
                                </td>
                                <td>{{doctor.crm}}</td>
                                <td>{{doctor.telephone}}</td>
                                <td>
                                    <ul class="list-group list-group-flush" v-for="specialty in doctor.specialties" v-bind:key="specialty.id">
                                        <li class="list-group-item">{{specialty.specialty.name}}</li>
                                    </ul>
                                </td>
                                <td>
                                    <button type="button" v-on:click="delDoctor(doctor)" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>

                                    <button type="button" v-on:click="goToEdit(doctor)" class="btn btn-outline-info"><i
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
                doctors: [],
                currentUrl: window.location.origin,
                searchTherm: null,
                searchUrl: "/api/doctor/name/--searchTherm--/00000000000/0/100"
            }
        },
        mounted() {
            this.getDoctors();
        },
        props: ['route'],
        methods: {
            searchDoctors: function(){
                var url = this.searchUrl.replace('--searchTherm--', this.searchTherm);

                window.axios.post('api/search', {
                    'name': this.searchTherm
                }).then((res) => {

                    this.doctors = res.data
                });
            },
            getDoctors: function () {
                window.axios.get('api/list').then((res) => {
                    this.doctors = res.data;
                })
            },
            delDoctor: function(doctor){
                window.axios.delete('../api/doctors/delete/' + doctor.id).then((res) => {
                    var message = 'Doctor Sucessfully Deleted';
                    var type = 'success';
                    this.showAlert(message, type);
                }).catch(error => {
                    console.log(error);
                    var message = error.response.data.error;
                    var type = 'danger';
                });
                this.doctors.pop(doctor);
            },
            goToEdit: function(doctor){
                window.location.href = 'edit/'+doctor.id;
            },
            showAlert: function(message, type){
                $("#myAlert").html("<div class='alert alert-"+type+" alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> "+message+"</div>");
                $("#myAlert").css("display", "");
            }
        }
    }
</script>

<style>
    .form-search-doctors{
        margin-bottom: 30px;
    }

    .form-button{
        float: right;
    }

    .card.card-small.card-doctors-search.mb-12 {
        display: flex;
        flex-direction: row;
        padding-top: 20px;
    }
    .card.card-small.card-doctors-search.mb-12 .form-group {
        padding-right: 0;
    }

    .card.card-small.card-doctors-search.mb-12 .form-group.form-button{

        padding-left: 3px;

    }
</style>
