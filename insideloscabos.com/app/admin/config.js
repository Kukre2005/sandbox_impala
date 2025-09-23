angular.module('myapp').service('env', function env() {

        var _environments = {
            local: {
                host: 'localhost',
                config: {
                    apiroot: 'http://www.insideloscabos.com'
                }
            },
            dev: {
                host: 'insideloscabos.com',
                config: {
                    apiroot: 'http://insideloscabos.com'
                }
            },
            test: {
                host: 'www.insideloscabos.com',
                config: {
                    apiroot: (window.location.protocol == 'https:')?'https://www.insideloscabos.com':'http://www.insideloscabos.com'
                }
            },
            stage: { 
                host: 'stage.com',
                config: {
                apiroot: 'staging'
                }
            },
            prod: {
                host: 'production.com',
                config: {
                    apiroot: 'production'
                }
            }
        },
        _environment;

        return {
            getEnvironment: function(){
                var host = window.location.host;
                if(_environment){
                    return _environment;
                }

                for(var environment in _environments){
                    if(typeof _environments[environment].host && _environments[environment].host == host){
                        _environment = environment;
                        return _environment;
                    }
                }

                return null;
            },
            get: function(property){
                return _environments[this.getEnvironment()].config[property];
            }
        }

    });
