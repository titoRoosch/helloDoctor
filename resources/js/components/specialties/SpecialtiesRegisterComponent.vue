<template>
<div class="main-content-container container-fluid px-4">    
<br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <!-- Quick Post -->
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Register Specialty</h6>
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
                            <label for="">Specialty Name *</label>
                            <input type="text" v-model="name" name="name" class="form-control" placeholder="" required> 
                        <br>
                        </div>
                        <div class="form-group mb-0">
                            <div class="col-xs-5">
                                <button class="btn btn-outline-primary float-right" type="submit">Register</button>
                            </div>
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
                name: null,
            }        
        },
        methods: {
            sendForm: function (e) {

                window.axios.post('../api/specialties/register', {
                    'name': this.name,
                }).then((res) => {
                    window.location.href = 'edit/'+res.data.id;
                    console.log('res', res);
                }).catch(error => {
                    console.log(error.response.data.error);
                });
                e.preventDefault();
            }
        }
    }
</script>
