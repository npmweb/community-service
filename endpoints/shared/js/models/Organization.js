var app = app || {};

app.Organization = Backbone.Model.extend({});

app.OrganizationCollection = Backbone.Collection.extend({
  model: app.Organization,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    } else {
      this.parentOrgId = param;
      // this.fetch({reset:true}); // bbgrid handles
    }
  },
  url: function() {
    return app.baseUrl
      + '/organizations?'
      + (this.parentOrgId ? 'org='+this.parentOrgId : '')
      + app.bustCache(true);
  },
  parse: function(response) {
    return response.organizations;
  }
});
