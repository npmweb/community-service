Community Service
=================

A Laravel web app for registering for service opportunities.

Installation
============

Make sure the following are installed on your system:

1. [Node.js, NPM](http://nodejs.org/), and [Grunt](http://gruntjs.com/installing-grunt) for build script.
2. [Composer](https://getcomposer.org/doc/00-intro.md) for PHP dependencies.
3. [Sass](http://sass-lang.com/install) (look for the command-line section) for stylesheets.

Then:

1. Create an app database starting with "l_". For example, "l_commsvc". Create a user who can access the database. For local, it's good to name the user and password the same name as the database. If you like, you can use `/app/database/scripts/create-database.sql` as a starting point.
2. Duplicate `.env.example.json` as `.env.json` and enter configuration options:
    - Database info, matching the above
    - CDN info, for where logo uploads are stored. By default, it will upload
      them to a server via FTP, and you can just enter the FTP connection info
      here. If you need to upload them via another protocol, you can make
      changes in `app/config/packages/graham-campbell/flysystem/config.php`.
    - Payment connection info, if your system will be accepting payment. This
      uses the `npmweb/payment` library, which currently only supports
      Braintree as a payment provider. Enter your Braintree account info here.
3. Run `npm install` to install the grunt packages for this project.
    - Note: on some OSes you may get this error: `Error: /usr/lib64/libstdc++.so.6: version `CXXABI_1.3.5' not found`. If so, check [this GitHub issue](https://github.com/sass/node-sass/issues/517) for help. The short version is that you may be able to run the following:
        - `sudo wget -O /etc/yum.repos.d/slc6-devtoolset.repo http://linuxsoft.cern.ch/cern/devtoolset/slc6-devtoolset.repo`
        - `sudo rpm --import http://ftp.mirrorservice.org/sites/ftp.scientificlinux.org/linux/scientific/51/i386/RPM-GPG-KEYs/RPM-GPG-KEY-cern`
        - `sudo yum install devtoolset-2-gcc.x86_64 devtoolset-2-binutils.x86_64 devtoolset-2-gcc-c++`
        - Then, instead of running a plain “npm install” within your project, run this: `SKIP_SASS_BINARY_DOWNLOAD_FOR_CI=1 CC=/opt/rh/devtoolset-2/root/usr/bin/gcc CXX=/opt/rh/devtoolset-2/root/usr/bin/g++ npm install`
4. Run `grunt`. This:
    - Installs PHP dependencies with `composer install`.
    - Creates symlinks for web assets with `symlink`.
    - Makes sure temp folders are writable with `chmod`.
    - Generates CSS from Sass.
    - Creates and populates the local database using
    
            php artisan migrate
            php artisan db:seed
            
    - Runs automated tests with `phpunit`
5. This application allows the frontend and backend to run on different domains, if you like. Set your web server to point `endpoints/frontend` and `backend` to the web address you want them at. For example, you could point http://myorganization.com/service to `endpoints/frontend` and http://intranet.myorganization.com/service to `endpoints/backend`.
7. Edit `endpoints/[backend and frontend]/.htaccess`, changing the RewriteBase line to the path your app is at
8. If you need to make changes to any code, run `grunt watch` (it will keep running in that terminal window). It will recompile CSS as Sass changes, as well as running PHPUnit tests if you set any up. You'll see an OS notification pop up if there are any problems.

Conventions and Gotchas
=======================

If you need to make changes to the code, these are things that are different
in our usage of Laravel from the typical stuff you'll see online.

* There is no app/controllers/ or app/models/ directory. Instead,
  the Controllers/ and Models/ (uppercase) directories are under
  app/src/NpmWeb/CommunityService. We do this so we have a place to put
  code that is neither Controllers nor Models, and also to better match
  our folders with namespaces. (However, app/views/ is still used for
  views.)
* Our apps are set up to support multiple "endpoints": different domains
  or paths where the app is accessible. This allows you to put the frontend
  and admin interface on different servers, if you like. Instead of a
  /public/ directory, we have /endpoints/backend/ and
  /endpoints/frontend/.
* Instead of basing our models on
  [Eloquent](http://laravel.com/docs/eloquent), they're based on an
  extension of Eloquent called
  [Ardent](https://github.com/laravelbook/ardent). This is just the same
  as Eloquent, except that validations are configured in the model and
  are run automatically when you call $model->save().
* We've [overridden the Form:: methods](https://github.com/npmweb/laravel-forms) to make a few changes:
    * All Form:: methods will output not just the form element, but also
      the label, error messaging, help text, etc. They are set up to
      work with the Foundation CSS framework, which we're standardized
      on going forward.
    * If you pass the option 'validate'=>true into the options of
      Form::model(), it will generate jQuery Validation rules for your form,
      generated from the validation rules configured in the model. That way validation happens on both the client and
      server side.
