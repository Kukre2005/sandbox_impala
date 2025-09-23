<div class="animated fadeIn" ng-init="init()" ng-controller="QuoteController">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Manage Quotes
                </div>
    <div class="form-group row">
                    <div class="col-md-1">
                        Items Per Page : 
                    </div>
                    <div class="col-md-1">
                        <select ng-model="itemsPerPageSelect" ng-change="setIpp(itemsPerPageSelect)"  ng-options="x for x in itemsPerPageData" class="form-control"></select>
                    </div>
                    
                </div>
                <table st-table="quotes" id="formRow"  st-safe-src="quotesServer" st-pipe="quoteServer" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th row-select-all="quotes"  selected="selected" ng-click="selectAll(quotes)"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Hotel Name</th>
                            <th>Activity Name</th>
                            <th>Service</th>
                            
                            <th class="sortable" st-sort="reservationDate">Reserve Date</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><input class="form-control" st-search="name"/></th>
                            <th><input class="form-control" st-search="email"/></th>
                            <th><input class="form-control" st-search="phone"/></th>
                            <th><select class="form-control" st-search="hotelId" >
                            <option value="">Select Hotel</option>     
                            <option ng-repeat="item in hotels" value="{{item.id}}">{{item.name}}</option>
                                </select></th>
                                <th><select class="form-control" st-search="actId" >
                            <option value="">Select Activity</option>     
                            <option ng-repeat="item in acts" value="{{item.id}}">{{item.name}}</option>
                                </select></th>
                            
                            <th><select class="form-control" st-search="service">
                                            <option value="">Select</option>
                                            <option value="one_way">One Way</option>
                                            <option value="round_trip">Round Trip</option>
                                </select>
                                <th><input type="date"  class="form-control" st-search="reservationDate"/></th>
                        </tr>
                    </thead>
                    <tbody ng-show="!isLoading">
                        <tr ng-if="quotes.length == 0"><td colspan="8">No record found.</td></tr>
                        <tr ng-repeat="row in quotes track by $index" >
                            <td row-select="row" ng-click="select(row.id)"></td>
                            <td>{{row.name}} <br><a href="javascript:void(0)" ng-click="showModel('quoteDetails',row)">View Details</a></td>
                            <td>{{row.email}}</td>
                            <td>{{row.phone}}</td>
                            <td>{{row.hotelName}}</td>
                            <td>{{row.actName}}</td>
                            <td>{{row.service|formatText}}</td>
                            <td>{{row.reservationDate}}</td>
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
                                    <div class="col-lg-6" align="left"><button type="button" v="{{selected}}" ng-disabled="!(selected.length > 0)" ng-click="deleteQuote()">Delete</button></div> 
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
