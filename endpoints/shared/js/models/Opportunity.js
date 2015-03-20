var app = app || {};

app.Opportunity = Backbone.Model.extend({});

app.OpportunityCollection = Backbone.Collection.extend({
  model: app.Opportunity,
  initialize: function( criteria ) {
    this.setCriteria(criteria);
  },
  url: function() {
    var url = app.baseUrl + '/opportunities?'
      + (this.criteria ? $.param(this.criteria) : '')
      + app.bustCache(true);
    return url;
  },
  parse: function(response) {
    return response.models;
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
