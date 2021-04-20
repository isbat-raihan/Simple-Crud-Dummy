@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a class="btn btn-success btn-sm pull-right" @click="create()">Add New</a>

                <div class="panel panel-default">
                    <div class="panel-heading">Bank Accounts</div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>AC NAME</th>
                                        <th>BRANCH</th>
                                        <th>ACCOUNT NO</th>
                                        <th>ACCOUNT TYPE</th>
                                        <th>ACTION</th>
                                    </tr>
                                    <tr v-for="row in data">
                                        <td>@{{ row.id }}</td>
                                        <td>@{{ row.account_name }}</td>
                                        <td>@{{ row.branch }}</td>
                                        <td>@{{ row.account_no }}</td>
                                        <td>@{{ row.account_type==1?'Current Account':(row.account_type==2?'Savings Account':'Joint Account') }}</td>
                                        <td>
                                            <button @click="edit(row)"
                                                    type="button"
                                                    class="btn btn-xs btn-warning"
                                                    title="Edit Record">Edit
                                            </button>
                                            <button @click="deleteRecord(row)"
                                                    type="button"
                                                    class="btn btn-xs btn-danger"
                                                    title="Delete Record">Del
                                            </button>

                                        </td>
                                    </tr>
                                </table>

                                <div class="modal fade" id="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal" aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title">@{{ isInsert?'New AC':'Edit AC'}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control input-sm" type="text"
                                                           v-model="BankAc.account_name">

                                                </div>
                                                <div class="form-group">
                                                    <label>branch</label>
                                                    <input class="form-control input-sm" type="text"
                                                           v-model="BankAc.branch">

                                                </div>
                                                <div class="form-group">
                                                    <label>account_no</label>
                                                    <input class="form-control input-sm" type="text"
                                                           v-model="BankAc.account_no">
                                                </div>

                                                <div class="form-group">
                                                    <label>account_type</label>
                                                    <select v-model="BankAc.account_type" class='form-control' required>
                                                        <option selected value="">Choose One</option>
                                                        <option value="1">Current</option>
                                                        <option value="2">Saving</option>
                                                        <option value="3">Joint</option>
                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    <label>Swift code</label>
                                                    <input class="form-control input-sm" type="text"
                                                           v-model="BankAc.swift_code">
                                                </div>
                                                <div class="form-group">
                                                    <label>Route No</label>
                                                    <input class="form-control input-sm" type="text"
                                                           v-model="BankAc.route_no">

                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button v-if="isInsert" type="button" class="btn btn-primary"
                                                        @click="store(BankAc)">Save
                                                </button>
                                                <button v-if="!isInsert" type="button" class="btn btn-primary"
                                                        @click="update(BankAc)">Update
                                                </button>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>


    <script>


        var csrtToken = '{{csrf_token()}}';
        var adminUrl='<?php echo e(url('admin')); ?>';


        var app = new Vue({
                el: '#app',
                data: {
                    data: [],
                    data2: [],
                    isInsert: true,
                    BankAc: {account_name: null,account_no: null,branch: null,account_type: null,swift_code:null,route_no:null,financial_organization_id:null},
                    errors:[]
                },
                created: function () {
                    this.init()
                },
                methods: {
                    init: function () {
                        this.$http.get('api/bankac')
                            .then(function (res) {
                                this.data = res.data
                            })
                    },

                    create: function () {
                        this.isInsert = true,
                            this.BankAc = {}
                        $('#modal').modal()
                    },
                    store: function (data) {
                        if (!confirm('Are you sure?')) return;
                        data._token = csrtToken;
                        this.$http.post(adminUrl + '/bankac/store', data)
                            .then(function (res) {
                                this.init();
                                $('#modal').modal('hide');
                                this.BankAc = {}
                            })
                        // .catch(function (error) {
                        //   this.errors = error;
                        //   console.log(error);
                        // })



                    },

                    edit: function (row) {
                        this.isInsert = false,
                            this.BankAc = row;
                        $('#modal').modal();
                    },
                    update:function(data){
                        if (!confirm('Are you sure?')) return;
                        data._token = csrtToken;
                        this.$http.post('admin/bankac/update',data)
                            .then(function (res) {
                                this.init()
                                $('#modal').modal('hide');
                                this.BankAc = {}
                            })
                    },
                    deleteRecord: function (row) {
                        if (!confirm('Are you sure?')) return;
                        row._token = csrtToken;
                        this.$http.post(adminUrl + '/bankac/delete', row)
                            .then(function (res) {
                                this.init()
                            })
                    },


                }
            })





        var app2 = new Vue({
            el:'#app2',
            data:{
                data:[],
                isInsert:true,
                Brand:{Brand_name: null,brand_desc: null,founded_at: null,phone: null,email: null,website: null,reg_no: null}
            },
            created:function(){
                this.brandInit()
            },
            methods:{
                brandInit:function(){
                    axios.get('/api/bank')
                        .then(response => {
                            this.data = response.data
                        })
                },


            }
        })

    </script>
@endsection
