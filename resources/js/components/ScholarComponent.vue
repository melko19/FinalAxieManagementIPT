<template>
    <div class="container">
        <div class="row">
            <div class="card bg-dark mt-1 text-white">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4>Scholar Management</h4>
                        </div>
                        <div class="col">
                            <div class="float-end">
                                <button  @click="create" type="button" class="btn btn-primary" >Add New Scholar</button>
                                <button @click="reload" type="button" class="btn btn-primary">Reload</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="m-3">
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Search By: </strong>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                  <select v-model="queryField" class="form-control">
                                    <option value="name">Name</option>
                                    <option value="email">EMAIL</option>
                                    <option value="phone">PHONE</option>
                                    <option value="address">ADDRESS</option>
                                    <option value="total_Slp">TOTAL Slp</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" v-model="query" class="form-control" placeholder="Search">
                            </div>
                        </div>
                    </div>
            </div>
            <table class="table table-dark table-hover mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PROFILE IMAGE</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>TOTAL SLP</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(scholar, index) in scholars" :key="scholar.id">
                        <td>{{index+1}}</td>
                        <td v-if="scholar.image !=null">
                            <img style="width:100px;" :src="'../storage/scholar/'+scholar.image" :alt="scholar.image">
                        </td>
                        <td v-else>
                            <img style="width:100px;" :src="'../storage/scholar/mms.png'" :alt="scholar.image">
                        </td>
                        <td>{{scholar.name}}</td>
                        <td>{{scholar.email}}</td>
                        <td>{{scholar.phone}}</td>
                        <td>{{scholar.total_Slp}}</td>
                        <td>
                            <button @click="edit(scholar)" type="button" class="btn btn-primary">Edit</button>
                            <button @click="destroy(scholar)" type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
                <pagination v-if="pagination.last_page > 1"
                    :pagination="pagination"
                    :offset="5"
                    @paginate="query === '' ? getData() : searchData()"
                ></pagination>
        </div>
        <vue-progress-bar></vue-progress-bar>
        <vue-snotify></vue-snotify>
            <div class="modal fade bg-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Scholar</h5>
                            <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="store()" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                    class="form-control" v-model="form.name" name="name" id="name" placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text"
                                    class="form-control" v-model="form.email" name="email" id="email" placeholder="Enter Your email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number"
                                    class="form-control" v-model="form.phone" name="phone" id="phone" placeholder="Enter Your phone">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" v-model="form.address" name="address" id="address" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="total_Slp">Total Slp</label>
                                    <input type="number"
                                    class="form-control" v-model="form.total_Slp" name="total_Slp" id="total_Slp" placeholder="Enter your Total SLP">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" @change="onFileChange" class="form-control-file" name="image" id="image" placeholder="image">
                                    <img style="width:150px;" :src="imagePreview" alt="">
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                            </form>
                        </div>
                 </div>
            </div>
        </div>
            <div class="modal fade bg-dark" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Scholar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form @submit.prevent="update()" method="post">
                       <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text"
                           class="form-control" v-model="form.name" name="name" id="name" placeholder="Enter Your Name">
                       </div>
                       <div class="form-group">
                         <label for="email">Email</label>
                         <input type="text"
                           class="form-control" v-model="form.email" name="email" id="email" placeholder="Enter Your email">
                       </div>
                       <div class="form-group">
                         <label for="phone">Phone</label>
                         <input type="number"
                           class="form-control" v-model="form.phone" name="phone" id="phone" placeholder="Enter Your phone">
                       </div>
                       <div class="form-group">
                         <label for="address">Address</label>
                         <textarea class="form-control" v-model="form.address" name="address" id="address" rows="3"></textarea>
                       </div>
                       <div class="form-group">
                         <label for="total_Slp">Total Slp</label>
                         <input type="number"
                           class="form-control" v-model="form.total_Slp" name="total_Slp" id="total_Slp" placeholder="Enter Your Amount">
                       </div>
                       <div class="form-group">
                         <label for="image">Image</label>
                         <input type="file" @change="onFileChange" class="form-control-file" name="image" id="image" placeholder="image">
                         <img v-bind:src="imagePreview == null ? '../storage/scholar/'+form.image : imagePreview" width="100" height="100"/> 
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                   </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
    export default {
        data() {
            return {
                imagePreview: null,
                query: "",
                queryField: "name",
                scholars: [],
                pagination: {
                        current_page:1,
                },
                form: new Form({
                    id: "",
                    name: "",
                    email: "",
                    phone: "",
                    address: "",
                    total_Slp: "",
                    image: "",
                }),
            }
        },
        watch: {
            query: function(newQ, old){
                if (newQ === "") {
                    this.getData();
                } else {
                    this.searchData();
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getData();
        },
        methods: {
            getData() {
                this.$Progress.start()
                axios.get('/api/scholar?page='+this.pagination.current_page)
                .then(response => {
                    this.scholars = response.data.data;
                    this.pagination = response.data.meta;
                    console.log(response)
                     this.$Progress.finish()
                })
                .catch(e => {
                    console.log(e);
                     this.$Progress.fail()
                })
            },
            searchData() {
                this.$Progress.start()
                axios.get('/api/search/scholar' + '/' + this.queryField + '/' + this.query + '?page=' + this.pagination.current_page)
                .then(response => {
                    this.scholars = response.data.data;
                    this.pagination = response.data.meta;
                    console.log(response)
                     this.$Progress.finish()
                })
                .catch(e => {
                    console.log(e);
                     this.$Progress.fail()
                })
            },
            reload() {
                this.$Progress.start()
                this.getData();
                this.query = "";
                this.queryField = "name";
                this.$snotify.success("Data Successfully Refresh", "Success");
            },
            create() {
                this.form.reset();
                this.form.clear();
                $("#exampleModal").modal("show");
            },
            onFileChange(event) {
                this.form.image = event.target.files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.imagePreview = reader.result;
                }.bind(this), false);
                if( this.form.image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.form.image.name ) ) {
                    reader.readAsDataURL( this.form.image );
                    }
                }
            },
            store() {
                this.$Progress.start();
                this.form.busy = true;
                this.form
                .post('/api/scholar')
                .then(response => {
                    this.getData();
                    $("#exampleModal").modal("hide");
                    if (this.form.successful) {
                     this.$Progress.finish();
                     this.$snotify.success("scholar Successfully Saved");
                    } else {
                     this.$Progress.fail();
                     this.$snotify.error(
                         "Something went wrong try again later.",
                         "Error"
                     );
                    }
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            edit(scholar) {
                this.form.reset();
                this.form.clear();
                this.form.fill(scholar);
                $("#EditModal").modal("show");
            },
            update() {
                this.$Progress.start();
                this.form.busy = true;
                this.form
                .post('/api/scholar/'+this.form.id)
                .then(response => {
                    this.getData();
                    $("#EditModal").modal("hide");
                    if (this.form.successful) {
                     this.$Progress.finish();
                     this.$snotify.success("scholar Update Successfully");
                    } else {
                     this.$Progress.fail();
                     this.$snotify.error(
                         "Something went wrong try again later.",
                         "Error"
                     );
                    }
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            destroy(scholar) {
                this.$snotify.clear();
                this.$snotify.confirm(
                    'You can not recover this data again!', 
                    'Are You Sure?', 
                    {
                        showProgressBar: false,
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons: [
                            {
                                text: 'Yes', 
                                action: (toast) => {
                                    this.$snotify.remove(toast.id);
                                    this.$Progress.start();
                                    this.form
                                    .delete('/api/scholar/'+ scholar.id)
                                    .then(response => {
                                        this.getData();
                                        this.$Progress.finish();
                                        this.$snotify.success("scholar Deleted Successfully");
                                        console.log(response);
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                                }, 
                                bold: true 
                            },
                            {text: 'No', action: () => console.log('Clicked: No')},
                            {text: 'Later', action: (toast) => {console.log('Clicked: Later'); this.$snotify.remove(toast.id); } },
                            {text: 'Close', action: (toast) => {console.log('Clicked: No'); this.$snotify.remove(toast.id); }, bold: true},
                        ]
                });
            }

        },
    }
</script>