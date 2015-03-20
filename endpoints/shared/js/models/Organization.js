var app = app || {};

app.Organization = Backbone.Model.extend({});

app.OrganizationCollection = Backbone.Collection.extend({
  model: app.Organization,
  initialize: function( criteria ) {
    this.setCriteria(criteria);
  },
  url: function() {
    return app.baseUrl + '/organizations?'
      + (this.criteria ? $.param(this.criteria) : '')
      + app.bustCache(true);
  },
  parse: function(response) {
    return response.organizations;
  },
  setCriteria: function( criteria ) {
    this.criteria = criteria;
    if( this.criteria ) {
      this.fetch({reset:true});
    } else {
      this.parse({models:[]});
      this.reset();
    }
  }
});
