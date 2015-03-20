var app = app || {};

app.CyoProjectRegistration = Backbone.Model.extend({});

app.CyoProjectRegistrationCollection = Backbone.Collection.extend({
  model: app.CyoProjectRegistration,
  initialize: function( orgUid ) {
    this.orgUid = orgUid;
    // this.fetch({reset:true});
  },
  url: function() {
    return app.baseUrl + '/cyo-project-registrations?org='+this.orgUid+app.bustCache(true);
  },
  parse: function(response) {
    return response.models;
  }
});
