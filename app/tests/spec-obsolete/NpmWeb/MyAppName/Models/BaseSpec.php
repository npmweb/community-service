<?php namespace spec\NpmWeb\MyAppName\Models;

use DB;
use PhpSpec\Laravel\EloquentModelBehavior;

abstract class BaseSpec extends EloquentModelBehavior
{
    protected function clearTables( $tableNames )
    {
        DB::statement('SET foreign_key_checks = 0');
        DB::statement('SET UNIQUE_CHECKS=0');
        foreach( $tableNames as $table ) {
            DB::table($table)->delete();
        }
        DB::statement('SET foreign_key_checks = 1');
        DB::statement('SET UNIQUE_CHECKS=1');
    }

    protected function resetEvents($modelClassNames)
    {
         // Reset their event listeners.
         foreach ($modelClassNames as $model) {

             // Flush any existing listeners.
             call_user_func(array($model, 'flushEventListeners'));

             // Reregister them.
             call_user_func(array($model, 'boot'));
         }
    }
}
