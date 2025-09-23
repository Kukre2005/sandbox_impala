<div class="animated fadeIn" ng-init="init()" ng-controller="BookingController">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Manage Bookings - {{heading}}
                </div>
          <div class="form-group row">
                    <div class="col-md-1">
                        Items Per Page : 
                    </div>
                    <div class="col-md-1">
                        <select ng-model="itemsPerPageSelect" ng-change="setIpp(itemsPerPageSelect)"  ng-options="x for x in itemsPerPageData" class="form-control"></select>
                    </div>
                    
                </div>
                
                <table st-table="bookings" id="formRow"  st-safe-src="bookServer" st-pipe="bookServer" class="table table-striped table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th row-select-all="bookings"  selected="selected" ng-click="selectAll(bookings)"></th>
                            <th>BookingID</th>
                            <th class="sortable" st-sort="createdAt">Booking Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Hotel</th>
                            <th>Book Status</th>
                            <th>Pay Status</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><input class="form-control" st-search="bookingId"/></th>
                            <th><input class="form-control" st-search="createdAt"/></th>
                            <th><input class="form-control" st-search="name"/></th>
                            <th><input class="form-control" st-search="email"/></th>
                            <th><input class="form-control" st-search="hotelId"/></th>
                            <th><select class="form-control" st-search="bookStatus">
                                            <option value="">Select</option>
                                            <option value="booked">Booked</option>
                                            <option value="canceled">Canceled</option>
                                </select>
                                    <th><select class="form-control" st-search="payStatus">
                                            <option value="">Select</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                </select></th>
                        </tr>
                    </thead>
                    <tbody ng-show="!isLoading">
                        <tr ng-if="bookings.length == 0"><td colspan="8">No record found.</td></tr>
                        <tr ng-repeat="row in bookings track by $index" >
                            <td row-select="row" ng-click="select(row.id)"></td>
                            <td>{{row.bookingId}} <br><a href="javascript:void(0)" ng-click="showModel('bookingDetails',row)">View Details</a></td>
                            <td>{{row.bookDate}}</td>
                            <td>{{row.name}}</td>
                            <td>{{row.email}}</td>
                            <td>{{row.hotelName}}</td>
                            <td><select name="" ng-change="changeStatus('booking','bookStatus',row.bookStatus,row.id,'#formRow')" ng-options="x as x for x in bookStatusData" ng-model="row.bookStatus">
                                </select></td>
                            <td>{{row.payStatus}}</td>
                        </tr>
                    </tbody>
                    <tbody ng-show="isLoading">
                        <tr>
                            <td colspan="8" class="text-center">Loading ... </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="8">
                                <div class="row">
                                    <div class="col-lg-6" align="left"><button type="button" v="{{selected}}" ng-disabled="!(selected.length > 0)" ng-click="deleteBook()">Delete</button></div> 
                                    <div class="col-lg-6" align="right" st-pagination="" st-items-by-page="itemsPerPage" ></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--/.col-->

        <!--        <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Striped Table
                        </div>
                        <div class="card-block">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Date registered</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Yiorgos Avraamu</td>
                                        <td>2012/01/01</td>
                                        <td>Member</td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Avram Tarasios</td>
                                        <td>2012/02/01</td>
                                        <td>Staff</td>
                                        <td>
                                            <span class="badge badge-danger">Banned</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quintin Ed</td>
                                        <td>2012/02/01</td>
                                        <td>Admin</td>
                                        <td>
                                            <span class="badge badge-default">Inactive</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Enéas Kwadwo</td>
                                        <td>2012/03/01</td>
                                        <td>Member</td>
                                        <td>
                                            <span class="badge badge-warning">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Agapetus Tadeáš</td>
                                        <td>2012/01/21</td>
                                        <td>Staff</td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Prev</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
        <!--/.col-->
    </div>
    <!--/.row-->

    <!--/.row-->
</div>
