NPM Laravel Template
====================

Base project for Laravel web applications, with NPM-specific
configuration and standards

Installation
============

Make sure the following are installed on your system:

1. [Node.js, NPM](http://nodejs.org/), and [Grunt](http://gruntjs.com/installing-grunt) for build script.
2. [Composer](https://getcomposer.org/doc/00-intro.md) for PHP dependencies.
3. [Sass](http://sass-lang.com/install) (look for the command-line section) for stylesheets.

Then, if this is your first time creating the project:

1. Run `composer create-project npmweb/laravel-template your-new-app-name -s dev` to create the project folder.
2. Add it to a Git repo.

Then, whether a new or existing project:

1. Create an app database starting with "l_". For example, "l_myappname". Create a user who can access the database. For local, it's good to name the user and password the same name as the database. If you like, you can use `/app/database/scripts/create-database.sql` as a starting point.
2. Then, create a test database by adding "_test" onto the end of your app database name. For example, "l_myappname_test". Give the same user access to it.
3. Duplicate `.env.example.json` as `.env.json` and enter the DB connection info and any other connection info.
4. Change the name of the app in the following places:
    - `app/src/NpmWeb/MyAppName` -- rename it to your app's name
    - `app/tests/` -- in multiple subdirs, look for `NpmWeb/MyAppName` and rename it to your app's name
    - Do a search-and-replace at the root of your project to replace "MyAppName" with your app's name that you chose above.
    - `app/views/[backend and frontend]/layouts/[_header and _headtag].blade`.php -- it should have already replaced MyApp Name with your app's name, but look and see if you want to add spaces, etc.
5. Run `sudo npm install` to install the grunt packages for this project.
6. Run `grunt`. This:
    - Installs PHP dependencies with `composer install`.
    - Creates symlinks for web assets with `symlink`.
    - Makes sure temp folders are writable with `chmod`.
    - Generates CSS from Sass.
    - Creates and populates the local database using
    
            php artisan migrate
            php artisan db:seed
            
    - Runs automated tests with `phpunit`
7. Set up MAMP to point `endpoints/frontend` and `backend` to the web address you want them at. For example, you could point http://local.my.northpointministries.net/myappname to `endpoints/frontend` and http://local.npmstaff.org/myappname to `endpoints/backend`
8. Edit `endpoints/[backend and frontend]/.htaccess`, changing the RewriteBase line to the path your app is at
9. When you're ready to code, run `grunt watch` (it will keep running in that terminal window). It will run unit tests as code changes, and recompile CSS as Sass changes. You'll see an OS  notification pop up if there are any problems.

Conventions and Gotchas
=======================

Laravel is very flexible, so we wanted to standardize it a bit. These
are things that are different in our usage of Laravel from the typical
stuff you'll see online.

* Security
    * Any time you output any content to a page, use our custom Escaping
      libraries--there is a [PHP version](https://bitbucket.org/npmweb/escaping)
      and a [JS version](https://bitbucket.org/npmweb/escaping-js), both of
      which have the same syntax. This takes some getting used to, but
      it's very important to prevent cross-site scripting. (Note that
      Form:: handles escaping for you, but if you are directly outputting
      something, you need to use the Escaping libraries.)
    * All your routes should be inside a csrf or csrf_resource form
      filter to protect against CSRF vulnerability.
* There is no app/controllers/ or app/models/ directory. Instead,
  the Controllers/ and Models/ (uppercase) directories are under
  app/src/NpmWeb/{YourAppName}. We do this so we have a place to put
  code that is neither Controllers nor Models, and also to better match
  our folders with namespaces. (However, app/views/ is still used for
  views.)
* Our apps are set up to support multiple "endpoints": different domains
  or paths where the app is accessible. This is mainly used to put the
  frontend on MyChurch and the backend on NPM Staff. Instead of a
  /public/ directory, we have /endpoints/backend/ and
  /endpoints/frontend/.
* Please put all application-specific code under
  src/NpmWeb/{YourAppName}. If you have any code that could be shared
  across different applications, please put it in a separate library.
* Instead of basing our models on
  [Eloquent](http://laravel.com/docs/eloquent), they're based on an
  extension of Eloquent called
  [Ardent](https://github.com/laravelbook/ardent). This is just the same
  as Eloquent, except that validations are configured in the model and
  are run automatically when you call $model->save().
* By default, we are using RESTful routes for our controllers. This
  just means that you should use
  [Route::resource()](http://laravel.com/docs/controllers#resource-controllers)
  in the routes.php file, rather than other Route:: methods. Use this
  unless you need specific routes, such as simplifying them on the
  frontend.
* We've [overridden the Form:: methods](https://github.com/npmweb/laravel-forms)
  to make a few changes:
    * All Form:: methods will output not just the form element, but also
      the label, error messaging, help text, etc. They are set up to
      work with the Foundation CSS framework, which we're standardized
      on going forward.
    * Your forms should always have client-side validation using jQuery
      Validation. If you pass the option 'validate'=>true into the
      options of Form::model(), it will generate jQuery Validation rules
      for your form, generated from the validation rules configured in
      the model. That way validation happens on both the client and
      server side. But if you need custom validation, you can write your
      own jQuery Validation code instead.
* Please don't forget to use the following.
    * [Migrations](http://laravel.com/docs/migrations) for any table
      setup or changes
    * [Seeds](http://laravel.com/docs/migrations#database-seeding) to
      set up any test data and/or production starter data.
    * [Composer](https://getcomposer.org/) for downloading dependencies
      (ask a team member for details)
    * require.js for loading JavaScript libraries. require.js is
      automatically set up by Composer when you [install frontend
      components via
      Composer](https://github.com/RobLoach/component-installer). Ask a
      team member for details.
