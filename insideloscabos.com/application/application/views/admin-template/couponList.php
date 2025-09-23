
<div class="animated fadeIn" ng-controller="ContactController">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Manage Coupons
                </div>
    <div class="card">
                <div class="card-header">
                    <strong>Add / Edit Coupon</strong>
                </div>
                 <form  method="post" id="formRow2"  name="couponForm" class="form-horizontal " ng-submit="addEditCoupon(couponForm)" ng-validate="validationOptions">
                     <input type="hidden" name="id" ng-model="formData.id" />
                <div class="card-block">
                
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="name">Coupon Code</label>
                            <div class="col-md-9">
                                <input type="text" id="code" name="code" ng-model="formData.code"  class="form-control" placeholder="Enter Coupon Code">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="type">Type</label>
                            <div class="col-md-3">
                                <select name="type"  ng-init="formData.type = typeData[0]"  ng-model="formData.type" ng-options="x as x for x in typeData" class="form-control"> </select>
                            </div>
                            <label class="col-md-3 form-control-label" for="email">Discount Cost</label>
                            <div class="col-md-3">
                                <input type="text" name="discountCost"  class="form-control"  ng-attr-placeholder="{{formData.type == 'percent'?'Enter Percent':'Enter Cost'}}"  ng-model="formData.discountCost">
                            </div>
                            
                        </div>
                        
                     

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary" name="submitButton" ng-model="submitBtn"  ng-disabled="couponForm.$invalid"><i class="fa fa-dot-circle-o"></i>{{btnName}}</button>
                     <button class="btn btn-sm btn-primary" name="submitButton2" ng-show="cancelShow" ng-click="cancelUpdate()" type="button" ><i class="fa fa-dot-circle-o"></i>Cancel</button>
                </div>
                  </form>
            </div>
                <table ng-init="initCoupon()"   st-table="couponsData" id="formRow" st-safe-src="coupons"  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th row-select-all="couponsData"  selected="selected" ng-click="selectAll(couponsData,itemsPerPage)" this-ngmodel="myselect"></th>
                            <th>Coupon Code</th>
                            <th>Type</th>
                            <th>Discount Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th><input class="form-control" st-search="code"/></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody ng-show="!isLoading">
                        <tr ng-if="coupons.length == 0"><td colspan="8">No record found.</td></tr>
                        <tr ng-repeat="row in couponsData track by $index" >
                            <td row-select="row" ng-click="select(row.id)"></td>
                            <td>{{row.code}}</td>
                            <td>{{row.type}}</td>
                            <td>{{row.discountCost}}</td>
                            <td><select name="" ng-change="changeStatus('coupon','status',row.status,row.id,'#formRow')" ng-model="row.status" ng-options="x as y for (x, y) in activeData">
                                    
                                </select></td>
                                <td><a href="javascript:void(0)" class="editClass" ng-click="editCoupon(row)">Edit</a></td>
                        </tr>
                    </tbody>
<!--                    <tbody ng-show="isLoading">
                        <tr>
                            <td colspan="8" class="text-center">Loading ... </td>
                        </tr>
                    </tbody>-->
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="8">
                                <div class="row">
                                    <div class="col-lg-6" align="left"><button type="button" v="{{selected}}" ng-disabled="!(selected.length > 0)" ng-click="deleteCoupon()">Delete</button></div>                                
                                    <div class="col-lg-6" align="right" st-pagination="" st-items-by-page="itemsPerPage"  st-displayed-pages="4"></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--/.col-->

        <!--/.col-->
    </div>
    <!--/.row-->

    <!--/.row-->
</div>
