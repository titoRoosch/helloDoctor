<template>
<div class="main-content-container container-fluid px-4">    
<br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <!-- Quick Post -->
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Register Doctor</h6>
                </div>
            <form @submit="sendForm" action="#" method="POST" enctype="multipart/form-data">
                <!--<p v-if="errors.lenght">
                    <ul>
                        <li v-for="error in errors">{{error}}</li>
                    </ul>
                </p>-->
                <div class="card-body d-flex flex-column">
                    <div class="quick-post-form">
                        <div class="form-group">
                            <label for="">Doctor Name *</label>
                            <input type="text" v-model="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="" required> 
                        <br>
                        </div>
                        <div class="form-group">
                            <label for="">CRM *</label>
                            <input type="text" v-model="crm" name="crm" class="form-control" id="exampleInputEmail1" placeholder="" required> 
                        <br>
                        </div>
                        <div class="form-group">
                            <label for="">Telephone *</label>
                            <input type="text" v-model="telephone" name="telephone" class="form-control" id="exampleInputEmail1" placeholder="" required> 
                        <br>
                        </div>
                        <br>
                            
                    </div>
              
                    <div class="form-group">
                        <label for="">Specialties (Min 2) *</label>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 mb-3" v-for="specialty in specialties" v-bind:key="specialty.id">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="specialtiesChk" class="custom-control-input" :value="specialty" :id="specialty.name" >
                                <label class="custom-control-label" :for="specialty.name"> {{specialty.name}}</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="col-xs-5">
                            <button class="btn btn-outline-primary float-right" type="submit">Register</button>
                        </div>
                    </div>
                </div>
                </form>
                </div>
                <!-- End Quick Post -->
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                specialties: [],
                specialtiesChk: [],
                name: null,
                crm: null,
                telephone: null
            }        
        },
        mounted() {
            console.log(this.$router);

            this.getSpecialties();

        },
        methods: {
            sendForm: function (e) {
                if(this.specialtiesChk.length < 2){
                    var message = "Minimum of two Specialties Required";
                    var type = 'danger';
                    this.showAlert(message, type);
                }else{
                    window.axios.post('../api/doctors/register', {
                        'name': this.name,
                        'crm': this.crm,
                        'telephone': this.telephone,
                        'specialties': this.specialtiesChk
                    }).then((res) => {
                        window.location.href = 'edit/'+res.data.id;
                    }).catch(error => {
                        var message = error.response.data.error;
                        var type = 'danger';
                        this.showAlert(message, type);
                    });
                }
                e.preventDefault();
            },
            getSpecialties: function () {
                window.axios.get('../specialties/api/list').then((res) => {
                    this.specialties = res.data;
                })
            },
            showAlert: function(message, type){
               $("#myAlert").html("<div class='alert alert-"+type+" alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> "+message+"</div>");
               $("#myAlert").css("display", "");
            },
        }
    }
</script>
