var app = app || {};

app.OpportunityOccurrence = Backbone.Model.extend({});

app.OpportunityOccurrenceCollection = Backbone.Collection.extend({
  model: app.OpportunityOccurrence,
  initialize: function( constraints ) {
    if( !constraints ) {
      constraints = {};
    }
    this.setConstraints(constraints);
  },
  setConstraints: function( constraints ) {
    this.constraints = constraints;
    this.update();
  },
  setConstraint: function( name, value ) {
    if( !this.constraints ) {
      this.constraints = {};
    }
    if( '' === value ) {
      delete this.constraints[name];
    } else {
      this.constraints[name] = value;
    }
    this.update();
  },
  update: function() {
    // if( _.isEmpty(this.constraints) ) {
    //  this.parse({models:[]});
    //  this.reset();
    // } else {
      this.fetch({reset:true});
    // }
  },
  url: function() {
    return app.baseUrl + '/opportunity-occurrences?'
      + $.param(this.constraints)
      +app.bustCache(true);
  },
  parse: function(response) {
    return response.models;
  }
});
