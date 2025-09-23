app.factory('dataFactory', function ($http,env) {
    var myService = {
        httpRequest: function (url, method, params, dataPost, upload,isEncrypt) {
            var passParameters = {};
            
            passParameters.url = env.get("apiroot")+url;

            if (typeof method == 'undefined') {
                passParameters.method = 'GET';
            } else {
                passParameters.method = method;
            }

            if (typeof params != 'undefined') {
                passParameters.params = params;
                passParameters.params = params;
            }

            if (typeof dataPost != 'undefined') {
                passParameters.data = dataPost;
            }

            if (typeof upload != 'undefined') {
                passParameters.upload = upload;
                passParameters.headers = {'Content-Type': undefined};
//                passParameters.transformRequest= function (data, headersGetter) {
//                        var formData = new FormData();
//                        angular.forEach(data, function (value, key) {
//                            formData.append(key, value);
//                        });
//                        return formData;
//                    };
            }
           



            console.log(passParameters);

            var promise = $http(passParameters).then(function (response) {
                if (typeof response.data == 'string' && response.data != 1) {
                    if (response.data.substr('loginMark')) {
                        location.reload();
                        return;
                    }
                    $.gritter.add({
                        title: 'Application',
                        text: response.data
                    });
                    return false;
                }
                if (response.data.jsMessage) {
                    $.gritter.add({
                        title: response.data.jsTitle,
                        text: response.data.jsMessage
                    });
                }
                return response.data;
            }, function () {

                $.gritter.add({
                    title: 'Application',
                    text: 'An error occured while processing your request.'
                });
            });
            return promise;
        }
    };
    return myService;
});


app.factory("authenticationSvc", function ($http, $q, $window) {
    var userInfo;

    function login(userName, password) {
        var deferred = $q.defer();

        $http.post("/login", {
            userName: userName,
            password: password
        }).then(function (result) {
            userInfo = {
                accessToken: result.data.access_token,
                userName: result.data.userName
            };
            $window.sessionStorage["userInfo"] = JSON.stringify(userInfo);
            deferred.resolve(userInfo);
        }, function (error) {
            deferred.reject(error);
        });

        return deferred.promise;
    }

    return {
        login: login
    };
});

app.factory('OfflineModel', function OfflineModel($filter, CryptoOfflineStorageService) {

    // Service logic
    // ...

    var _key = null,
            _items = null,
            _fields = null
            ;

    // Public API here
    return {
        _secret: 'my-awesome-key',
        init: function (key, _items, params) {

            var self = this;
            _key = key;
            params = params || {};
            var i = _items;

            CryptoOfflineStorageService.init({secret: self._secret});
            _items = CryptoOfflineStorageService.get(_key);
            if (!_items) {
                CryptoOfflineStorageService.set(_key, _items);
                _items = i;
            }
            self.setListItems(_items, params);

            //  Extend params for create a factory in service
            return angular.extend(self, params);
        },
        createValueObject: function (item) {
            var obj = {};
            angular.forEach(_fields, function (field) {
                obj[field] = item[field] || '';
            });
            return obj;
        },
        setKey: function (key) {
            _key = key;
            return this;
        },
        getKey: function () {
            return _key;
        },
        setListItems: function (items) {
            _items = items;
            return this;
        },
        getListItems: function () {
            return _items;
        },
        setFields: function (fields) {
            _fields = fields;
            return this;
        },
        countTotalItems: function (items) {
            return ($filter('max')(items, '_id') || 0) + 1;
        },
        create: function (item) {
            item = this.createValueObject(item);
            item._id = this.countTotalItems(_items);
            _items.push(item);
            CryptoOfflineStorageService.set(_key, _items);
            return _items;
        },
        update: function (item) {
            _items = _items.map(function (element) {
                if (element._id === item._id) {
                    element = item;
                }
                return element;
            });
            CryptoOfflineStorageService.set(_key, _items);
            return _items;
        },
        delete: function (index) {
            var db = this.getListItems();
            var _id = db.filter(function (element, pos) {
                if (element._id === index) {
                    element.pos = pos;
                    return element;
                }
            });

            if (_id.length > 0) {
                var item = db.splice(_id[0].pos, 1);
                if (typeof item[0] === 'object') {
                    this.setListItems(db);
                    CryptoOfflineStorageService.set(_key, db);
                    return item[0];
                }
            }
            return false;
        }
    };

});