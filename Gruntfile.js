/**
 * Requires npm, which is part of node.js <http://nodejs.org/>
 * To run:
 *   npm install
 *   grunt
 */
module.exports = function(grunt) {
  grunt.initConfig({
    custom_config: grunt.file.readJSON('.env.json'),
    pkg: grunt.file.readJSON('package.json'),
    paths: {
      shared: 'endpoints/shared',
      frontend: 'endpoints/frontend',
      backend: 'endpoints/backend',
      sass: 'includes/scss',
      css: 'includes/css',
      js: 'includes/js',
      src: 'app/src',
      tests: 'app/tests',
      docs: 'docs',
      views: 'app/views',
      routes: 'app/routes.php',
      config: 'app/config'
    },

    clean: {
      symlink: [
        '<%= paths.frontend %>/includes/shared',
        '<%= paths.backend %>/includes/shared',
      ],
      sass: [
        '<%= paths.frontend %>/<%= paths.css %>/dist',
        '<%= paths.backend %>/<%= paths.css %>/dist'
      ],
      js: [
        '<%= paths.frontend %>/<%= paths.js %>/dist',
        '<%= paths.backend %>/<%= paths.js %>/dist'
      ],
      bower: [
        '<%= paths.frontend %>/includes/vendor',
        '<%= paths.backend %>/includes/vendor'
      ]
    },
    symlink: {
      includes: {
        files: [
            {
              src: '<%= paths.shared %>',
              dest: '<%= paths.frontend %>/includes/shared'
            },
            {
              src: '<%= paths.shared %>',
              dest: '<%= paths.backend %>/includes/shared'
            }
        ]
      }
    },
    chmod: {
        options: {
          mode: '777'
        },
        logs: {
          src: [
            'app/storage/',
            'app/storage/cache/',
            'app/storage/logs/',
            'app/storage/meta/',
            'app/storage/sessions/',
            'app/storage/views/',
            'vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer'
          ]
        }
    },
    phpunit: {
      classes: {
        dir: '<%= paths.tests %>/phpunit'
      },
      options: {
        colors: true
      }
    },
    /*
    phpspec: {
      app: {
        specs: '<%= paths.tests %>/spec'
      }
    },
    */
    phpdocumentor: {
      dist: {
        options: {
          directory : '<%= paths.src %>',
          target : '<%= paths.docs %>'
        }
      }
    },
    shell: {
      bowerFrontend: {
        command: 'bower install',
        options: {
          execOptions: {
            cwd: '<%= paths.frontend %>'
          }
        }
      },
      bowerBackend: {
        command: 'bower install',
        options: {
          execOptions: {
            cwd: '<%= paths.backend %>'
          }
        }
      },
      migrate: {
        command: function() {
          return 'php artisan migrate';
        }
      },
      dbseed: {
        command: function() {
          return 'php artisan db:seed';
        }
      },
      composer: {
        command: 'composer install'
      },
      composerDontPromptForChanges: {
        command: [
          'composer config --global discard-changes true',
          'composer install --no-interaction'
        ].join('&&')
      },
      clearCache: {
        // sudo because cache files owned by apache on server, and not writable
        command: 'sudo php artisan cache:clear'
      }
    },
    copy: {
      css: {
        files: [
          { src: '<%= paths.frontend %>/<%= paths.css %>/dist/main.min.css',
            dest: ".backup/<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>/" },
          { src: '<%= paths.backend %>/<%= paths.css %>/dist/main.min.css',
            dest: ".backup/<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>/" }
        ]
      },
      js: {
        files: [
          { src: '<%= paths.frontend %>/<%= paths.js %>/dist/vendor.combined.min.js',
            dest: ".backup/<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>/" },
          { src: '<%= paths.backend %>/<%= paths.js %>/dist/vendor.combined.min.js',
            dest: ".backup/<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>/" }
        ]
      }
    },
    sass: {
      backend: {
        options: {
          outputStyle: 'compressed',
          includePaths: ['<%= paths.backend %>/includes/vendor/foundation/scss']
        },
        files: {
          '<%= paths.backend %>/<%= paths.css %>/dist/main.min.css':
            '<%= paths.backend %>/<%= paths.sass %>/main.scss'
        }
      },
      frontend: {
        options: {
          outputStyle: 'compressed',
          includePaths: ['<%= paths.frontend %>/includes/vendor/foundation/scss']
        },
        files: {
          '<%= paths.frontend %>/<%= paths.css %>/dist/main.min.css':
            '<%= paths.frontend %>/<%= paths.sass %>/main.scss'
        }
      }
    },
    wiredep: {
      localBackend: {
        src: [
          'app/views/backend/layouts/scripts/_local.blade.php'
        ],
        options: {
          directory: 'endpoints/backend/includes/vendor',
          bowerJson: require('./endpoints/backend/bower.json'),
          ignorePath: '../../../../../endpoints/backend/'
        },
        fileTypes: {
          html: {
            replace: {
              js: '<script src="\{\{asset(\'{{filePath}}\')\}\}"></script>',
            }
          },
        }
      },
      localFrontend: {
        src: [
          'app/views/frontend/layouts/scripts/_local.blade.php'
        ],
        options: {
          directory: 'endpoints/frontend/includes/vendor',
          bowerJson: require('./endpoints/frontend/bower.json'),
          ignorePath: '../../../../../endpoints/frontend/'
        },
        fileTypes: {
          html: {
            replace: {
              js: '<script src="\{\{asset(\'{{filePath}}\')\}\}"></script>',
            }
          },
        }
      },
      releaseBackend: {
        src: [
          'app/views/backend/layouts/scripts/_for-usemin.blade.php'
        ],
        options: {
          directory: 'endpoints/backend/includes/vendor',
          bowerJson: require('./endpoints/backend/bower.json'),
          ignorePath: '../../../../../endpoints/backend/'
        }
      },
      releaseFrontend: {
        src: [
          'app/views/frontend/layouts/scripts/_for-usemin.blade.php'
        ],
        options: {
          directory: 'endpoints/frontend/includes/vendor',
          bowerJson: require('./endpoints/frontend/bower.json'),
          ignorePath: '../../../../../endpoints/frontend/'
        }
      }
    },
    useminPrepare: {
      backend: {
        src: 'app/views/backend/layouts/scripts/_for-usemin.blade.php',
        options: {
          dest: 'endpoints/backend'
        }
      },
      frontend: {
        src: 'app/views/frontend/layouts/scripts/_for-usemin.blade.php',
        options: {
          dest: 'endpoints/frontend'
        }
      }
    },
    db_dump: {
      db: {
        options: {
          title: "<%= custom_config.DB_SCHEMA %>",
          host: "<%= custom_config.DB_HOST %>",
          database: "<%= custom_config.DB_SCHEMA %>",
          user: "<%= custom_config.DB_USERNAME %>",
          pass: "<%= custom_config.DB_PASSWORD %>",
          backup_to: "backups/<%= custom_config.DB_SCHEMA %>-<%= grunt.template.today('yyyy-mm-dd-HH-MM-ss') %>.sql"
        },
      }
    },
    watch: {
      bower: {
        files: ['bower.json'],
        tasks: [
          'shell:bowerFrontend',
          'shell:bowerBackend',
          'wiredep:localFrontend',
          'wiredep:localBackend'
        ]
      },
      phpunit: {
        files: [
          '<%= paths.tests %>/phpunit/**/*.php',
          '<%= paths.src %>/**/*.php'
        ],
        tasks: ['phpunit','notify:phpunit']
      },
      // phpspec: {
      //   files: [
      //     '<%= paths.tests %>/spec/**/*.php',
      //     '<%= paths.src %>/**/*.php'
      //   ],
      //   tasks: ['phpspec','notify:phpspec']
      // },
      sass: {
        files: [
          '<%= paths.backend %>/<%= paths.sass %>/**/*.scss',
          '<%= paths.frontend %>/<%= paths.sass %>/**/*.scss'
        ],
        tasks: ['sass','notify:sass']
      }
    },
    notify: {
      phpunit: {
        options: {
          title: 'PHPUnit',
          message: 'All tests passed.'
        }
      },
      // phpspec: {
      //   options: {
      //     title: 'phpspec',
      //     message: 'All tests passed.'
      //   }
      // },
      sass: {
        options: {
          title: 'Sass',
          message: 'CSS updated.'
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-chmod');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-symlink');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-mysql-dump');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-phpunit');
  // grunt.loadNpmTasks('grunt-phpspec');
  grunt.loadNpmTasks('grunt-phpdocumentor');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-wiredep');
  grunt.loadNpmTasks('grunt-usemin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('default', [
    'shell:composer',
    'symlink',
    'chmod',
    'shell:bowerFrontend',
    'shell:bowerBackend',
    'sass',
    'wiredep:localFrontend',
    'wiredep:localBackend',
    'shell:migrate',
    'shell:dbseed',
    'phpunit'
  ]);
  grunt.registerTask('test', [
    'shell:composerDontPromptForChanges',
    'symlink',
    'chmod',
    'shell:bowerFrontend',
    'shell:bowerBackend',
    'sass',
    'myusemin',
    'shell:migrate',
    'shell:dbseed',
    'shell:clearCache'
  ]);
  grunt.registerTask('production', [
    'shell:composerDontPromptForChanges',
    'symlink',
    'chmod',
    'shell:bowerFrontend',
    'shell:bowerBackend',
    'sass',
    'myusemin',
    'shell:migrate',
    'shell:clearCache'
  ]);
  grunt.registerTask('myusemin', [
    'wiredep:releaseFrontend',
    'wiredep:releaseBackend',
    'useminPrepare:frontend',
    'useminPrepare:backend',
    'concat',
    'uglify'
    // don't call usemin itself because it overwrites the block in the file
    // we are using Laravel and a hard-coded script tag to handle that
  ]);
}
