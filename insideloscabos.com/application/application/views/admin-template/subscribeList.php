<div class="animated fadeIn" ng-init="initSubscribe()" ng-controller="ContactController">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" >
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Manage Subscribers
                </div>
   
                <table st-table="subscribes" id="formRow"  st-safe-src="subscribeServer" st-pipe="subscribeServer" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th row-select-all="subscribes"  selected="selected" ng-click="selectAll(subscribes)"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="sortable" st-sort="createdAt">Subscribe Date</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><input class="form-control" st-search="name"/></th>
                            <th><input class="form-control" st-search="email"/></th>
                            <th><input type="date" format="dd/mm/yyyy" class="form-control" st-search="createdAt"/></th>
                        </tr>
                    </thead>
                    <tbody ng-show="!isLoading">
                        <tr ng-if="subscribes.length == 0"><td colspan="8">No record found.</td></tr>
                        <tr ng-repeat="row in subscribes track by $index" >
                            <td row-select="row" ng-click="select(row.id)"></td>
                            <td>{{row.name}}</td>
                            <td>{{row.email}}</td>
                          
                            <td>{{row.subscribeDate}}</td>
                        </tr>
                    </tbody>
                    <tbody ng-show="isLoading">
                        <tr>
                            <td colspan="10" class="text-center">Loading ... </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="10">
                                <div class="row">
                                    <div class="col-lg-6" align="left"><button type="button" v="{{selected}}" ng-disabled="!(selected.length > 0)" ng-click="deleteSubscribe()">Delete</button></div> 
                                    <div class="col-lg-6" align="right" st-pagination="" st-items-by-page="itemsPerPage" ></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--/.col-->

    </div>
    <!--/.row-->

    <!--/.row-->
</div>
