<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>

<template>
    <div class="container">
        <div>
            <loading-app/>
        </div>
        <h5> OFFENDER PROFILE: {{ this.offender.FirstName }}  {{ this.offender.LastName }}, ID: {{ this.offender.id }} </h5>
        <!-- <H4>{{ this.offender.FirstName }} , {{ this.offender.LastName }}, ID: {{ this.offender.id }} </h4> -->
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="width: 928px; height: 280px; background-image:url('./img/offender-frame-333.jpg')">
                    <h3 class="widget-user-username">{{this.offender.FirstName}}</h3>
                    <h5 class="widget-user-desc">{{this.offender.LastName}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle mt-3" :src="getProfilePhoto()" alt="Offender Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{this.cases.length}}</h5>
                                <span class="description-text">CASES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">{{this.offender.FirstName}} {{this.offender.LastName}}</h5>
                            <span class="description-text">NAME</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">{{this.offender.Nationality}}</h5>
                            <span class="description-text">NATIONALITY</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show green" href="#case" data-toggle="tab">Cases</a></li>
                        <li class="nav-item"><a class="nav-link green"  href="#business" data-toggle="tab">Business</a></li>
                        <li class="nav-item"><a class="nav-link green"  href="#network" data-toggle="tab">Network</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Case Tab -->
                            <div class="tab-pane active show" id="case">
                                <h3 class="text-center">Related Cases List</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in cases" :key="item.id">
                                                <h5><u><b>ID: {{item.id}}</b></u></h5>
                                                <h5>Detected Date: {{item.DetectedDate}}</h5>
                                                <h5>Type: {{getStrType(item.Type)}} </h5>
                                                <h5>Item Number: {{ item.ItemNumber | decFormat }} {{getStrUnit(item.Unit)}}</h5>
                                                <h5>Amount: {{item.Amount | decFormat}}</h5>
                                                <h5>Description: {{item.CaseDescription}}</h5>
                                                <h5>Evidence: {{item.Evidence}}</h5>
                                                <h5>Location: {{getStrLocation(item.Location)}}</h5>
                                                <h5>Status: {{getStrStatus(item.Status)}}</h5>
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in cases" :key="item.id">
                                                <p> Evidence Photo, You can edit the case with this: 
                                                    <a href="#">
                                                        <i v-tooltip="editcasetooltip" class="fa fa-edit green" @click="editCaseModal(item)"></i>
                                                    </a>
                                                </p>
                                                <div class="widget-user-image">
                                                    <img class="img-thumbnail mt-3" :src="getEvidencePhoto(item.Evidence)" style="width:300px; height:200px" alt="Evidence Avatar">
                                                </div>
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Network Tab -->
                            <div class="tab-pane" id="network">
                                <h3 class="text-center">Display relate offender Network</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in network" :key="item.id">
                                                <h5><u><b>ID: {{item.id}}</b></u></h5>
                                                <h5>Mob Name: {{item.MobName}}</h5>
                                                <!-- <h5>Network Type: {{getStrType(item.Type)}} </h5> -->
                                                <h5>Member Number: {{item.MemberNumber}}</h5>
                                                <h5>Network Activity: {{item.NetworkActivity}}</h5>
                                                <h5>Main Address: {{item.MainAddress}}</h5>
                                                <h5>Crime Level: {{item.CrimeLevel}}</h5>
                                                <!-- <h5>Country: {{getStrLocation(item.Country)}}</h5>
                                                <h5>Status: {{getStrStatus(item.Status)}}</h5> -->
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in network" :key="item.id">
                                                <p> Business Logo </p>
                                                <div class="widget-user-image">
                                                    <img class="img-circle mt-3" :src="getCompanyLogo(item.MobLogo)" style="width:200px; height:180px" alt="Offender Avatar">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Business Tab -->
                            
                            <div class="tab-pane" id="business">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in business" :key="item.id">
                                                <h5><u><b>ID: {{item.id}}</b></u></h5>
                                                <h5>Company Name: {{item.CompanyName}}</h5>
                                                <!-- <h5>Type: {{getStrType(item.Type)}} </h5> -->
                                                <h5>Owner: {{item.Owner}}</h5>
                                                <h5>Activity: {{item.Activity}}</h5>
                                                <h5>Address: {{item.Address}}</h5>
                                                <h5>Country: {{item.Country}}</h5>
                                                <h5>Phone: {{item.Phone}}</h5>
                                                <h5>Email: {{item.Email}}</h5>
                                                <h5>Latitude: {{item.latitude}}</h5>
                                                <h5>Longtitude: {{item.longtitude}}</h5>
                                                <h5>Social Network: {{item.SocialNetwork}}</h5>
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul>
                                            <li v-for="item in business" :key="item.id">
                                                <p> Business Logo </p>
                                                <div class="widget-user-image">
                                                    <img class="img-circle mt-3" :src="getCompanyLogo(item.CompanyLogo)" style="width:200px; height:180px" alt="Offender Avatar">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
         <div class="modal fade" id="editCaseModal" tabindex="-1" role="dialog" aria-labelledby="editCaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCaseModalLabel">Edit Case id: {{formcase.id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateCaseForm()" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="offender_id">Offender ID:</label>
                                    <input v-model="formcase.offender_id" type="text" name="offender_id" readonly
                                        class="form-control" :class="{ 'is-invalid': formcase.errors.has('offender_id') }">
                                    <has-error :form="formcase" field="offender_id"></has-error>
                                </div>
                            
                                <div class="form-group col-6">
                                    <label for="DetectedDate">Detected Date:</label>
                                    <input v-model="formcase.DetectedDate" type="date" name="DetectedDate"
                                    placeholder="Detected Date"
                                    class="form-control" :class="{ 'is-invalid': formcase.errors.has('DetectedDate') }">
                                    <has-error :form="formcase" field="DetectedDate"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="Type">Case Type:</label>
                                    <select name="Type" v-model="formcase.Type" id="Type" class="form-control" :class="{ 'is-invalid': formcase.errors.has('Type') }">
                                        <option value="">Select Case Type</option>
                                        <option v-for="type in types" :key="type.id" :value='type.id'>{{ type.TypeEng }}</option>
                                    </select>
                                    <has-error :form="formcase" field="DetectedDate"></has-error>
                                </div>
                                <div class="form-group col-6">
                                    <label for="ItemNumber">Item Number:</label>
                                    <input v-model="formcase.ItemNumber" type="text" name="ItemNumber"
                                        placeholder="Items Number..."
                                        class="form-control" :class="{ 'is-invalid': formcase.errors.has('ItemNumber') }">
                                    <has-error :form="formcase" field="ItemNumber"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="Unit">Unit:</label>
                                    <select name="Unit" v-model="formcase.Unit" id="Unit" class="form-control" :class="{ 'is-invalid': formcase.errors.has('Unit') }">
                                        <option value="">Select Case Unit</option>
                                        <option v-for="unit in units" :key="unit.id" :value='unit.id'>{{ unit.UnitEng }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="Amount">Amount:</label>
                                    <input v-model="formcase.Amount" type="number" name="Amount"
                                        placeholder="Case Amount value..."
                                        class="form-control" :class="{ 'is-invalid': formcase.errors.has('Amount') }">
                                    <has-error :form="formcase" field="Amount"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="CaseDescription">Case Description:</label>
                                    <textarea v-model="formcase.CaseDescription" name="CaseDescription" id="CaseDescription"
                                        placeholder="Breif CaseDescription ...."
                                        class="form-control" :class="{ 'is-invalid': formcase.errors.has('CaseDescription') }"></textarea>
                                    <has-error :form="formcase" field="CaseDescription"></has-error>
                                </div>
                                <div class="form-group col-6">
                                    <label for="Location">Location:</label>
                                    <select name="Location" v-model="formcase.Location" id="Location" class="form-control" :class="{ 'is-invalid': formcase.errors.has('Location') }">
                                        <option value="">Select Location</option>
                                        <option v-for='province in locations' :value='province.id' :key='province.id'>{{ province.NameEng }}</option>
                                    </select>
                                    <has-error :form="formcase" field="Location"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="Status">Status:</label>
                                    <select name="Status" v-model="formcase.Status" id="Status" class="form-control" :class="{ 'is-invalid': formcase.errors.has('Status') }">
                                        <option value="">Select Status</option>
                                        <option v-for="status in statuses" :key="status.id" :value='status.id'>{{ status.StatusEng }}</option>
                                    </select>                                                                                                                       
                                    <has-error :form="formcase" field="Status"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <div class="file-field">
                                        <div class="btn btn-success btn-md float-left">
                                            <span>Photo: </span><input type="file" name="Evidence" id="Evidence" @change="selectPicture($event)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
        <!-- Modal -->
    </div>
</template>

<script>
    export default {
        props: ['msg','offender'],
        data(){
            return {
                welcome: 'This is your profile',
                editcasetooltip: '',
                bid: '',
                nid: '',
                types: {},
                units: {},
                cases: {},
                statuses: {},
                locations: {},
                totalcases: 0,
                network: {},
                business: {},
                case: {},
                formcase: new Form ({
                    id: '',
                    offender_id: '',
                    DetectedDate: '',
                    Type: '',
                    ItemNumber: '',
                    Unit: '',
                    Amount: '',
                    CaseDescription: '',
                    Evidence: '',
                    Status: '',
                    Location: '',
                    User_id: '',
                    Action: ''
                }),      
            }
        },
        mounted() {
            this.cases = this.getCases(this.offender.id);
            this.network = this.getNetworks(this.offender.MainNetwork);
            this.business = this.getBusinesses(this.offender.MainBusiness);
            this.getCaseTypes();
            this.getUnits();
            this.getStatus();
            this.getLocation();
            if (this.msg) {
                this.welcome = this.msg;
              //  this.offender1 = this.offender;
               // this.getCases(this.offender.id);
                //this.todo = JSON.parse(JSON.stringify(this.populateWith))
               // this.form.fill(JSON.parse(JSON.stringify(this.offender))); 
              // this.offender = {};   
              // this.form.fill(this.offender);
            }
            console.log('Offender Profile Detail Component mounted...')
        },

        methods:{
            getStrType(id){
                return this.types[id-1].TypeEng;
            },
            getStrUnit(id){
                return this.units[id-1].UnitEng;
            },
            getStrStatus(id){
                return this.statuses[id-1].StatusEng;
            },
            getStrLocation(id){
                return this.locations[id-1].NameEng;
            },
            getCases(offender_id){
                axios.get("api/getCases", {
                    params: {
                        offender_id: offender_id
                    },
                    }).then(function(response){
                        this.cases = response.data;
                        console.log(this.cases);
                    }.bind(this));
            },
            getNetworks(network_id){
                axios.get("api/getNetworks/" + network_id) 
                    .then(function(response){
                        this.network = response.data;
                        console.log(this.network);
                    }.bind(this));
                /* axios.get("api/getNetworks", {
                    params: {
                        nid: network_id
                    },
                    }).then(function(response){
                        this.network = response.data;
                        console.log(this.network);
                    }.bind(this)); */
            },
            getBusinesses(business_id){
                axios.get("api/getBusinesses/" + business_id)
                    .then(function(response){
                        this.business = response.data;
                        console.log(this.business);
                    }.bind(this));
                /* axios.get("api/getBusinesses", {
                    params: {
                        bid: business_id
                    },
                    }).then(function(response){
                        this.business = response.data;
                        console.log(this.business);
                    }.bind(this)); */
            },
            getCaseTypes(){
                axios.get("api/getCaseTypes").then(({data}) => (this.types = data));
            },
            getUnits(){
                axios.get("api/getUnits").then(({data}) => (this.units = data));
            },
            getStatus(){
                axios.get("api/getCaseStatus").then(({data}) => (this.statuses = data));
            },
            getLocation(){
                axios.get("api/getProvinces").then(({data}) => (this.locations = data));
            },
            getProfilePhoto(picture){
                let photo = (this.offender.Photo.length > 200) ? this.offender.Photo : "/storage/images/"+ this.offender.Photo ;
                // let logo = (picture.length > 200) ? picture : "/storage/images/"+ picture ;
                return photo; 
            },
            getCompanyLogo(picture){
                let logo = (picture.length > 200) ? picture : "/storage/images/"+ picture ;
                return logo; 
            },
            getEvidencePhoto(picture){
                let photo = (picture.length > 200) ? picture : "/storage/images/"+ picture ;
                return photo; 
            },
            editCaseModal(item){
               // alert('Doing later...');
               $('#editCaseModal').modal('show');
               this.formcase.fill(item);
               
            },
            selectPicture(e){
                let file = e.target.files[0];
            // console.log(this.file);
                let reader = new FileReader();
                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                        this.formcase.Evidence = reader.result;
                    }
                    reader.readAsDataURL(file);               
                }else{
                    swal({
                        type: 'error',
                        title: 'Ooops..',
                        text: 'File size is more than 2MB...',
                    })
                }
            },
            updateCaseForm(){
                this.formcase.put('api/mcase')           
                    .then(() => {
                            // success
                            $('#editCaseModal').modal('hide');
                            swal(
                                'Updated!',
                                'Information has been updated.',
                                'success'
                                )
                                this.$Progress.finish();
                                Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
          //--------------------------------- old stuff --------------------------------
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },

        created() {
            /* this.cases = this.getCases(this.offender.id);
            this.network = this.getNetworks(this.offender.MainNetwork);
            console.log(this.network);
            this.business = this.getBusinesses(this.offender.MainBusiness);
            this.getCaseTypes();
            this.getUnits();
            this.getStatus();
            this.getLocation(); */
        }
    }
</script>
