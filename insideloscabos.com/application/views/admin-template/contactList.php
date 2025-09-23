<div class="animated fadeIn" ng-init="init()" ng-controller="ContactController">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Manage Contacts
                </div>
   
                <table st-table="contacts" id="formRow"  st-safe-src="contactServer" st-pipe="contactServer" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th row-select-all="contacts"  selected="selected" ng-click="selectAll(contacts)"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Hotel Name</th>
                            <th>Passengers</th>
                            <th>Service</th>
                            
                            <th class="sortable" st-sort="createdAt">Contact Date</th>
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
                            <th></th>
                            <th><select class="form-control" st-search="service">
                                            <option value="">Select</option>
                                            <option value="one_way">One Way</option>
                                            <option value="round_trip">Round Trip</option>
                                </select>
                                <th><input type="date" format="dd/mm/yyyy" class="form-control" st-search="createdAt"/></th>
                        </tr>
                    </thead>
                    <tbody ng-show="!isLoading">
                        <tr ng-if="contacts.length == 0"><td colspan="8">No record found.</td></tr>
                        <tr ng-repeat="row in contacts track by $index" >
                            <td row-select="row" ng-click="select(row.id)"></td>
                            <td>{{row.name}}<br><a href="javascript:void(0)" ng-click="showModel('contactDetails',row)">View Details</a></td>
                            <td>{{row.email}}</td>
                            <td>{{row.phone}}</td>
                            <td>{{row.hotelName}}</td>
                            <td>{{row.passengers}}</td>
                            <td>{{row.service|formatText}}</td>
                            <td>{{row.contactDate}}</td>
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
                                    <div class="col-lg-6" align="left"><button type="button" v="{{selected}}" ng-disabled="!(selected.length > 0)" ng-click="deleteContact()">Delete</button></div> 
                                    <div class="col-lg-6" align="right" st-pagination="" st-items-by-page="5" ></div>
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
