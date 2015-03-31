# Community Service

A Laravel web app for registering for service opportunities.

## Installation

Make sure the following are installed on your system:

1. [Node.js, NPM](http://nodejs.org/), and [Grunt](http://gruntjs.com/installing-grunt) for build script.
2. [Composer](https://getcomposer.org/doc/00-intro.md) for PHP dependencies.

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
8. Make sure both the frontend and backend come up. You can log in to the backend with the default user `superadmin` / `password`
9. If you want the system to notify you if a registration closes without anyone being signed up for it, set up a cron to execute `php artisan occurrence:notifyCancelled`

## Initial Setup

Once the app is up and running, you'll want to do some customization for your installation:

* Go to the backend Config page to edit the system name and to configure filter, registration, and payment settings.
* Go to the backend Churches page to set up one or more churches that serving will happen under.
* Go to the Users page to set up users. You can either use the built-in users table, or use a different third-party Laravel authentication driver, i.e. to authenticate against LDAP.
* For extra security, enter a new encryption key value in `app/config/app.php`

## Usage

### Data Model
The Community Service system uses the following data model:

* **Campaigns** are different time periods that serving happens in, allowing you to only view data for the current campaign at one time.
* **Churches** are organizations organizing the community service. (The name for these will eventually be configurable, so the system can be used by non-churches, such as companies.) This is not necessarily the nonprofit organization that sets up the projects itself. For example, First Baptist Church could be the church, working with Toys for Tots as a beneficiary.
* **Beneficiaries** are nonprofit organziations through whom the serving happens, such as "Toys For Tots".
* **Service Opportunities** are types of projects that can be done, such as "Sort and Pack Toy Donations". A beneficiary can have multiple service opportunities.
* **Occurrences** are individual dates and times that a service opportunity happens on. A service opportunity can have multiple occurrences--this keeps you from having to copy-and-paste quite so much.
* **Filter Attributes** are custom filterable fields for service opportunities. You can set them up to track things like whether money is required, whether children can come, etc. These correspond to filter controls on the frontend.
* **Registrations** are, well, registrations. It's one form submission. Depending on your settings, a registration can be for multiple participants.
* **Create-Your-Own Project Registrations** are for people to report time they spent on a service opportunity they came up with on their own.
* **Participants** are multiple people included in one registration. You have the option of setting up a service opportunity to require names to be provided for all participants.

### General Steps

To use the system:

1. Create beneficiaries
2. Create or import service opportunities and occurrences of them.
3. Send users to the frontend to register for your service opportunities.
4. As users register, depending on your settings, either the churches and/or the beneficiaries may receive emails notifying them of registrations.
5. You can log in to the system to run reports for yourself or for the beneficiaries, to inform them about participants who will be coming.


## Conventions and Gotchas

If you need to make changes to the code, these are things that are different
in our usage of Laravel from the typical stuff you'll see online.

* Any time you're changing code, run `grunt watch` (it will keep running in that terminal window). It will recompile CSS as Sass changes, as well as running PHPUnit tests if you set any up. You'll see an OS notification pop up if there are any problems.
* There are no `app/controllers/` or `app/models/` directories. Instead,
  all classes are under app/src/NpmWeb/CommunityService.
* However, you'll notice there aren't any controllers or models under there,
  either--and not a ton of views. Most of the core application logic is in a
  Composer package called
  [service-opportunities](https://github.com/npmweb/service-opportunities). This
  allows you to make tweaks to some of the specifics of the app like
  look-and-feel, while still pulling down the latest fixes and features from the
  core logic by just doing a `composer update`. If you need to make changes to
  that core code, you can fork service-opportunities and change
  your `composer.json` to point to your fork. But if you're making bug fixes, be
  sure to pull-request them back over to us!
* Our apps are set up to support multiple "endpoints": different domains
  or paths where the app is accessible. This allows you to put the frontend
  and admin interface on different servers, if you like. Instead of a
  `public/` directory, we have `endpoints/backend/` and
  `endpoints/frontend/`. (`/endpoints/shared` makes shared assets available to
  both.)
* Instead of basing our models on
  [Eloquent](http://laravel.com/docs/eloquent), they're based on an
  extension of Eloquent called
  [Ardent](https://github.com/laravelbook/ardent). This is just the same
  as Eloquent, except that validations are configured in the model and
  are run automatically when you call `$model->save()`.
* We've [overridden the Form:: methods](https://github.com/npmweb/laravel-forms) to make a few changes:
    * All Form:: methods will output not just the form element, but also
      the label, error messaging, help text, etc. They are set up to
      work with the Foundation CSS framework, which we're standardized
      on going forward.
    * If you pass the option 'validate'=>true into the options of
      Form::model(), it will generate jQuery Validation rules for your form,
      generated from the validation rules configured in the model. That way validation happens on both the client and
      server side.

# Open Items

The following are issues and limitations we're aware of:

* Currently organizations display with the label "Church". We will eventually make this configurable if you are not a church and want to use this system.
* The system handles setting up different campaigns that start and end, but there is not currently a user interface for working with them. Changes need to be made directly in the database.
* Importing custom "filter attributes" is currently disabled until we improve the logic to make it dynamic for any attributes you might set up.

# License

This application is open-sourced under the MIT license. See the `LICENSE` file for more details.