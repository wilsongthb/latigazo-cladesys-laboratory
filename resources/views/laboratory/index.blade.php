<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laboratorio</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.lumen.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body>

        <div class="container" ng-app="laboratory" ng-controller="RootController">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="text-center">Trabajos encargados de laboratorio</h1>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <a href="" class="btn btn-success" ng-click="html.LabJob.create()">
                                    <i class="fa fa-plus"></i> Crear</a>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="LaboratoryJobs.search" ng-model-options="{debounce: 200}" ng-change="LaboratoryJobs.get()">
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">ID</th>
                                        <th class="hidden-xs">Tipo</th>
                                        <th>Descripcion</th>
                                        <th class="hidden-xs">Fecha de encargo</th>
                                        <th class="hidden-xs">Fecha de entrega</th>
                                        <!-- <th></th> -->
                                        <th class="col-lg-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="d in LaboratoryJobs.data.data | filter: LaboratoryJobs.search">
                                        <td class="hidden-xs" ng-bind="d.id"></td>
                                        <td class="hidden-xs" ng-bind="d.type"></td>
                                        <td class="col-xs-6">
                                            <span class="visible-xs">
                                                <span class="label label-default">ID: @{{d.id}} </span>
                                            </span>
                                            @{{d.description}}
                                            <span class="visible-xs">
                                                <span class="label label-primary">Tipo: @{{d.type}} </span>
                                                <span class="label label-default">Encargo: @{{d.charge}} </span>
                                                <span class="label label-default">Entrega: @{{d.deliver}} </span>
                                            </span>
                                        </td>
                                        <td class="hidden-xs" ng-bind="d.charge"></td>
                                        <td class="hidden-xs" ng-bind="d.deliver"></td>
                                        <!-- <td></td> -->
                                        <td>
                                            <div class="form-inline">
                                                <select 
                                                    class="form-control" 
                                                    ng-class="{ 'btn-success': (d.status_id == 4) }"
                                                    ng-model="d.status_id" 
                                                    ng-click="LaboratoryJobStatus.newStatus(d.id, d.status_id)">
                                                    <option ng-repeat="(k, s) in Values.config.job_status" value="@{{k}}" ng-bind="s"></option>
                                                </select>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-warning" ng-click="html.LabJob.edit(d)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="" class="btn btn-danger" ng-click="html.LabJob.delete(d.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul uib-pagination total-items="LaboratoryJobs.data.total" ng-model="LaboratoryJobs.data.current_page" ng-change="LaboratoryJobs.get()"
                                items-per-page="Values.config.per_page" boundary-link-numbers="true" max-size="5" class="pagination-sm"
                                boundary-links="true" force-ellipses="true"></ul>
                        </div>
                    </div>

                </div>
            </div>
            
            
            <!-- <a class="btn btn-primary" data-toggle="modal" href='#lab-job-create-modal'>Trigger modal</a> -->
            <div class="modal fade" id="lab-job-create-modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Trabajo de Laboratorio</h4>
                        </div>
                
                
                        <form ng-submit="LaboratoryJobs.save(html.LabJob.hideModal)">
                            <div class="modal-body">
                                
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Descripcion</label>
                                            <input type="text" class="form-control" ng-model="LaboratoryJobs.reg.description" list="description-jobs">
                                            <datalist id="description-jobs">
                                                @foreach($job_descriptions as $item)
                                                    <option value="{{$item}}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de encargo</label>
                                            <p class="input-group">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    ng-model="LaboratoryJobs.reg.charge"
                                                    ui-mask="9999-99-99 99:99:99"
                                                    model-view-value="true">    
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="html.LabJob.insertNowCharge()">Ahora</button>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Fecha de entrega</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                ng-model="LaboratoryJobs.reg.deliver"
                                                ui-mask="9999-99-99 99:99:99"
                                                model-view-value="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Doctor(a)</label>
                                            <input type="text" class="form-control" ng-model="LaboratoryJobs.reg.clinic_doctor_name" list="doctor-names">
                                            <datalist id="doctor-names">
                                                @foreach($doctor_names as $item)
                                                    <option value="{{$item}}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Paciente</label>
                                            <input type="text" class="form-control" ng-model="LaboratoryJobs.reg.clinic_patient_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tipo</label>
                                            <select ng-model="LaboratoryJobs.reg.type_id" class="form-control">
                                                <option ng-repeat="ljt in LaboratoryJobTypes.data" value="@{{ljt.id}}" ng-bind="ljt.value"></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Observaciones</label>
                                            <textarea rows="4" class="form-control" ng-model="LaboratoryJobs.reg.observation"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <h2>Historial Estados</h2>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>ESTADO</th>
                                                    <th>FECHA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="s in LaboratoryJobs.reg.status_list">
                                                    <td ng-bind="s.id"></td>
                                                    <td ng-bind="Values.config.job_status[s.status_id]"></td>
                                                    <td ng-bind="s.created_at"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{asset('node_modules/font-awesome/css/font-awesome.min.css')}}">
        <script src="{{asset('node_modules/angular/angular.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css')}}">
        <script src="{{asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js')}}"></script>
        <script src="{{asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js')}}"></script>
        <script src="{{asset('node_modules/angular-ui-mask/dist/mask.min.js')}}"></script>
        
        <script>
        const Values = {
            url: '{{url('')}}',
            apiUrl: '{{url('rsc')}}/',
            config: {!! json_encode(config('laboratory')) !!}
        };

        (function() {
            'use strict';
        
            angular.module('laboratory', [
                'ui.bootstrap',
                'ui.mask'
            ]);
        })();

        (function() {
            'use strict';
        
            angular
                .module('laboratory')
                .controller('RootController', RootController);
        
            RootController.$inject = ['$scope', '$http'];
            function RootController($scope, $http) {
                var vm = this;

                $scope.Values = Values
                $scope.html = {
                    LabJob: {
                        hideModal: function(){
                            $('#lab-job-create-modal').modal('hide')
                        },
                        create: function(){
                            $scope.LaboratoryJobs.reg = {}
                            $('#lab-job-create-modal').modal('show')
                        },
                        edit: function(d){
                            $scope.LaboratoryJobs.reg = d
                            $('#lab-job-create-modal').modal('show')
                        },
                        delete: function(id){
                            if(confirm('Estas seguro de Eliminar el registro ' + id)){
                                $scope.LaboratoryJobs.delete(id)
                            }
                        },
                        insertNowCharge: function(){
                            $scope.LaboratoryJobs.reg.charge = new Date().toISOString().slice(0, 19).replace('T', ' ')
                        }
                    }
                }

                $scope.LaboratoryJobTypes = {
                    get: function(){
                        $http.get(Values.apiUrl + 'laboratory-job-types')
                        .then(
                            res => {
                                this.data = res.data
                            }
                        )
                    }
                }

                $scope.LaboratoryJobStatus = {
                    newStatus: function(job_id, status_id, cBack = false){
                        console.log(arguments)
                        $http.post(Values.apiUrl + 'laboratory-job-add-status', { 
                            job_id,
                            status_id 
                        })
                        .then(
                            res => {
                                // setTimeout(() => {
                                if(cBack) cBack(res)
                                // }, 500);
                            }
                        )
                    }
                }

                $scope.LaboratoryJobs = {
                    data: {},
                    table: 'laboratory-jobs',
                    get: function(){
                        $http.get(Values.apiUrl + this.table, {
                            params: {search: this.search, page: this.data.current_page}
                        })
                        .then(
                            res => {
                                this.data = res.data
                            }
                        )
                    },
                    save: function(cBack = false){
                        var fcBack = res => {
                            this.get()
                            if(cBack) cBack(res)
                        }

                        if(!this.reg.id){
                            // crear
                            $http.post(Values.apiUrl + this.table, this.reg)
                            .then(
                                res => {
                                    this.get()
                                    fcBack()
                                }
                            )
                        }else{
                            // editar
                            $http.put(Values.apiUrl + this.table + '/' + this.reg.id, this.reg)
                            .then(
                                res => {
                                    this.get()
                                    fcBack()
                                }
                            )
                        }
                    },
                    delete: function(id){
                        $http.delete(Values.apiUrl + this.table + '/' + id)
                        .then(
                            res => {
                                this.get()
                            }
                        )
                    }
                }
        
                activate();
        
                ////////////////
        
                function activate() { 
                    $scope.LaboratoryJobs.get()
                    $scope.LaboratoryJobTypes.get()
                }
            }
        })();
        </script>
    </body>
</html>
