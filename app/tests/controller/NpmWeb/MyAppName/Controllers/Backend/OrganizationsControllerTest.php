<?php

namespace NpmWeb\MyAppName\Controllers\Backend;

use Auth;
use Mockery;
use NpmWeb\LaravelTest\BackendTestCase;

/**
 * Controller test goals: for each action, test each different situation
 * of data coming in (no data, invalid, valid, etc.). Use mocks to make
 * sure each collaborator is called correctly. Test the response: was the
 * correct exception thrown? Was the right status returned? Was the right
 * view called, and the right data passed to it?
 */
class OrganizationsControllerTest extends BackendTestCase {

    public function setUp()
    {
        parent::setUp();

        Auth::shouldReceive('guest')
            ->andReturn(false);
        Auth::shouldReceive('check')
            ->andReturn(true);

        // We want to use the real controller but mock out the model,
        // so we create a full mock model and pass it into the IoC
        // container.
        $this->model = Mockery::mock('NpmWeb\MyAppName\Models\Organization');
        $this->app->instance('NpmWeb\MyAppName\Models\Organization',$this->model);

        $this->config = Mockery::mock('NpmWeb\MyAppName\Models\Config');
        $this->app->instance('NpmWeb\MyAppName\Models\Config',$this->config);
        $this->config
            ->shouldReceive('singleton')
            ->andReturn($this->config);
        $this->config
            ->shouldReceive('getAttribute')->with('system_name')
            ->andReturn('Community Service');
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testIndexHtmlSuccess() {
        // arrange
        Auth::shouldReceive('user')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\User', function($mock) {
                $mock->shouldReceive('getAttribute')
                    ->with('user_type')
                    ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                        $tMock->shouldReceive('getAttribute')
                            ->with('super')
                            ->andReturn(true);
                        }));
            }));

        // act
        $this->call('GET', 'organizations');

        // assert: has data
        $this->assertResponseOk();
    }

    public function testIndexJsonSuccessAll() {
        // arrange
        Auth::shouldReceive('user')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\User', function($mock) {
                $mock->shouldReceive('getAttribute')
                    ->with('user_type')
                    ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                        $tMock->shouldReceive('getAttribute')
                            ->with('super')
                            ->andReturn(true);
                        }));
            }));
        $models = [1,2,3];
        $this->model
            ->shouldReceive('all')
            ->andReturn(Mockery::mock('Illuminate\Database\Eloquent\Collection',
                function($cMock) {
                    $cMock
                        ->shouldReceive('toArray')
                        ->andReturn([1,2,3]);
                }));

        // act
        $response = $this->call('GET', 'organizations', [], [], ['HTTP_Accept'=>'application/json']);
        $jsonObj = $response->getData();

        // assert: has data
        $this->assertResponseOk();
        $this->assertEquals('success',$jsonObj->status);
        $this->assertEquals($models,$jsonObj->models);
    }

    public function testCreate() {

        // arrange
        Auth::shouldReceive('user')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\User', function($mock) {
                $mock->shouldReceive('getAttribute')
                    ->with('user_type')
                    ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                        $tMock->shouldReceive('getAttribute')
                            ->with('super')
                            ->andReturn(true);
                        }));
            }));
        $this->model
            ->shouldReceive('getAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('setAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('hasGetMutator')
            ->andReturn(false);

        // act
        $this->call('GET', 'organizations/create');

        // assert: did not error out
        $this->assertResponseOk();
        $this->assertViewHas('model',$this->model);
    }

    public function testStoreError() {
        // arrange
        $input = array();
        $this->model
            ->shouldReceive('fill')
            ->with($input);
        $this->model
            ->shouldReceive('save')
            ->andReturn(false);
        $this->model
            ->shouldReceive('errors')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                $tMock->shouldReceive('any')
                    ->andReturn(true);
                $tMock->shouldReceive('all')
                    ->andReturn(array('name'=>'name is required'));
            }));

        // act
        $response = $this->call('POST', 'organizations', $input);

        // assert: errored out
        $this->assertRedirectedToRoute('organizations.create');
        $this->assertSessionHasErrors(array('name'));
    }

    public function testStoreSuccess() {
        // arrange
        $input = array('name'=>'Foo');
        $this->model
            ->shouldReceive('fill')
            ->with($input);
        $this->model
            ->shouldReceive('save')
            ->andReturn(true);
        $this->model
            ->shouldReceive('errors')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                $tMock->shouldReceive('any')
                    ->andReturn(false);
            }));

        // act
        $response = $this->call('POST', 'organizations', $input);

        // assert: success redirect
        $this->assertRedirectedToRoute('organizations.index');
        $this->assertSessionHas('myflash','Your record has been created.');
    }

    public function testShowError() {
        // arrange
        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->once()
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

        // act
        $this->call('GET', 'organizations/'.$id);

        // assert: exception thrown
        $this->assertResponseStatus(404);
    }

    public function testShowSuccess() {
        // arrange
        Auth::shouldReceive('user')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\User', function($mock) {
                $mock->shouldReceive('getAttribute')
                    ->with('user_type')
                    ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                        $tMock->shouldReceive('getAttribute')
                            ->with('super')
                            ->andReturn(true);
                        }));
            }));

        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($this->model);
        $this->model
            ->shouldReceive('getAttributes')
            ->andReturn(array());
        $this->model
            ->shouldReceive('getAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('setAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('hasGetMutator')
            ->andReturn(false);

        // act
        $this->call('GET', 'organizations/'.$id);

        // assert: errored out
        $this->assertResponseOk();
        $this->assertViewHas('model',$this->model);
    }

    public function testEditError() {
        // arrange
        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

        // act
        $this->call('GET', 'organizations/'.$id.'/edit');

        // assert: exception thrown
        $this->assertResponseStatus(404);
    }

    public function testEditSuccess() {
        // arrange
        Auth::shouldReceive('user')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\User', function($mock) {
                $mock->shouldReceive('getAttribute')
                    ->with('user_type')
                    ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                        $tMock->shouldReceive('getAttribute')
                            ->with('super')
                            ->andReturn(true);
                        }));
            }));
        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($this->model);
        $this->model
            ->shouldReceive('getAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('setAttribute')
            ->andReturn(null);
        $this->model
            ->shouldReceive('hasGetMutator')
            ->andReturn(false);

        // act
        $this->call('GET', 'organizations/'.$id.'/edit');

        // assert: succeeded
        $this->assertResponseOk();
        $this->assertViewHas('model',$this->model);
    }

    public function testUpdateNotFoundError() {
        // arrange
        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

        // act
        $this->call('PUT', 'organizations/'.$id);

        // assert: exception thrown
        $this->assertResponseStatus(404);
    }

    public function testUpdateValidationError() {
        // arrange
        $id = 27;
        $input = array();
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($this->model);
        $this->model
            ->shouldReceive('fill')
            ->with($input);
        $this->model
            ->shouldReceive('save')
            ->andReturn(false);
        $this->model
            ->shouldReceive('errors')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                $tMock->shouldReceive('any')
                    ->andReturn(true);
                $tMock->shouldReceive('all')
                    ->andReturn(array('name'=>'name is required'));
            }));

        // act
        $this->call('PUT', 'organizations/'.$id, $input);

        // assert: errored out
        $this->assertRedirectedToRoute('organizations.edit',$id);
        $this->assertSessionHasErrors(array('name'));
    }

    public function testUpdateSuccess() {
        // arrange
        $id = 27;
        $input = array('name'=>'Foo');
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($this->model);
        $this->model
            ->shouldReceive('fill')
            ->with($input);
        $this->model
            ->shouldReceive('save')
            ->andReturn(true);
        $this->model
            ->shouldReceive('errors')
            ->andReturn(Mockery::mock('NpmWeb\MyAppName\Models\UserType', function($tMock) {
                $tMock->shouldReceive('any')
                    ->andReturn(false);
            }));

        // act
        $this->call('PUT', 'organizations/'.$id, $input);

        // assert: success redirect
        $this->assertRedirectedToRoute('organizations.show',$id);
        $this->assertSessionHas('myflash','Your record has been updated.');
    }

    public function testDestroyError() {
        // arrange
        $id = '27';
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

        // act
        $this->call('DELETE', 'organizations/'.$id);

        // assert: exception thrown
        $this->assertResponseStatus(404);
    }

    public function testDestroySuccess() {
        // arrange
        $id = 27;
        $this->model
            ->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn($this->model);
        $this->model
            ->shouldReceive('delete');

        // act
        $this->call('DELETE', 'organizations/'.$id);

        // assert: succeeded
        $this->assertRedirectedToRoute('organizations.index');
        $this->assertSessionHas('myflash','Your record has been deleted!');
    }

}