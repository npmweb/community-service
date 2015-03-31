var app = app || {};

app.User = Backbone.Model.extend({});

app.UserCollection = Backbone.Collection.extend({
  model: app.User,
  initialize: function( orgUid ) {
    this.orgUid = orgUid;
    // this.fetch({reset:true});
  },
  url: function() {
    var url = app.baseUrl + '/users';
    if( this.orgUid ) {
      url += '?org='+this.orgUid+app.bustCache(true);
    } else {
      url += app.bustCache(false);
    }
    return url;
  },
  parse: function(response) {
    return response.models;
  }
});
