<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Employee;
use App\Employee_Position;
use Carbon\Carbon;

class TargetSolutionsController extends Controller
{
    public function getEmployees(){
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
        
        $request = $client->get('https://api.targetsolutions.com/v1/users');
        $response = $request->getBody();
        $employees = (json_decode($response, true));

        foreach ($employees['users'] as $row) {
            \App\Employee::updateOrCreate(
                [   'id' => $row['userid']
                ], 
                [   'name_last'=> $row['lastname'],
                    'name_first' => $row['firstname'],
                    'status' => $row['status']
                ] );
        }
        return response()->json(['success'=>'Employees successfully added']);
    }

    public function getEmployeesProfile(){
       
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);

        $employees = \App\Employee::where('status', 'Active')->get();

        //Delete all Can Act Records
        //$deletedCanActRows = \App\Employee_Position::where('can_act', 1)->delete(); 
        $deletedCanActRows = \App\Employee_Position::query()->delete();

        foreach ($employees as $employee) {
            $url = 'http://api.targetsolutions.com/v1/users/'.$employee->id.'/groups';
            
            $request = $client->get($url);
            $response = $request->getBody();
            $groups = (json_decode($response, true));
            
            foreach ($groups['groups'] as $row) {
                $employeeUpdate = \App\Employee::find($employee->id);
                if ($row['categoryid'] == 31275){ //ORGANIZATION
                    $employeeUpdate->organization = $row['groupname'];
                    $employeeUpdate->save();
                }
                if ($row['categoryid']== 30223){ //POSITION
                    $employeeUpdate->position = $row['groupname'];
                    $employeeUpdate->save();

                     \App\Employee_Position::Create(
                        [   'employee_id'=> $employee->id,
                            'can_act' => 0,
                            'position_id' => $row['groupid'],
                            'position' => $row['groupname']
                        ] );

                    /*\App\Employee_Position::updateOrCreate(
                        [   'employee_id'=> $employee->id,
                            'can_act' => 0
                        ],      
                        [  'position_id' => $row['groupid'],
                            'position' => $row['groupname']
                        ] );*/
                        
                }
                 
                if ($row['categoryid']== 35200){ //CAN ACT
                    switch ($row['groupid']) {
                        case 788208: // Can Act As Engineer
                            $positionid = 578125;
                            break;
                        case 749219: // Can Act As Lieuntent
                            $positionid = 578147;
                            break;
                        case 815608: // Can Act As Battalion Chief
                            $positionid = 578096;
                            break;
                        case 815609: // Can Act As District Chief
                            $positionid = 578123;
                            break;
                        case 858213: // Can Act As Captain
                            $positionid = 578111;
                             break;
                        case 858272: // Can Act As Incident Safety Officer
                            $positionid = 858652;
                            break;
                        case 856564: // Can Act As EMS Battalion Supervisor
                            $positionid = 882783;
                            break;
                        case 856565: // Can Act As EMS District Supervisor
                            $positionid = 701685;
                            break;
                    }
                    \App\Employee_Position::Create( 
                        [  'employee_id'=> $employee->id,
                            'position_id' => $positionid,
                            'position' => $row['groupname'],
                            'can_act' => 1
                        ] );
                }
             
                if ($row['categoryid']== 30844){ //SHIFT
                    $employeeUpdate->shift = $row['groupname'];
                    $employeeUpdate->save();
                }
            }
        }
        return response()->json(['success'=>'Employees Can Act, Position, Organizaion and Shift successfully added']);
    }
    
    public function getPositions(){
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
        
        $request = $client->get('http://api.targetsolutions.com/v1/sites/categories/profile/30223/groups');
        $response = $request->getBody();
        $position= (json_decode($response, true));

        foreach ($position['profilegroups'] as $row) {
            \App\Position::updateOrCreate(
                [   'id' => $row['groupid']
                ], 
                [   'name'=> $row['groupname']
                ] );
        }
        return response()->json(['success'=>'Positions successfully added']);
        
    }

    public function getCredentials(){
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
        
        $request = $client->get('http://api.targetsolutions.com/v1/credentials');
        $response = $request->getBody();
        $position= (json_decode($response, true));

        foreach ($position['credentials'] as $row) {
            \App\Credential::updateOrCreate(
                [   'id' => $row['credentialid']
                ], 
                [   'name'=> $row['credentialname']
                ] );
        }
        return response()->json(['success'=>'Credentials successfully added']);
        
    }

    public function getEmployeeCredentials(){
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
        
        $request = $client->get('https://api.targetsolutions.com/v1/credentials/assignments');
        $response = $request->getBody();
        $credential = (json_decode($response, true));

        //Delete all Credential Records
        $deleteAllEmployeeCredentials = \App\Employee_Credential::query()->delete();

        foreach ($credential['assignments'] as $row) {
            if ($row['expirationdate'] == '') {
                $expiry = null;
            } else {
                $expiry = Carbon::parse($row['expirationdate'])->format('Y-m-d');
            }
    
            \App\Employee_Credential::Create(
                [   'employee_id' => $row['USERID'],
                    'credential_id' => $row['credentialid'],
                    'date_expiration' => $expiry,
                    'status' => $row['status']
                ] );
        }
        return response()->json(['success'=>'Employee Credentials successfully added']);
        
    }

    public function getEmployeesCredentialsComplete(){
       
        $headers = [
            'AccessToken' => config('services.TargetSolutions.AccessToken'),
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);

        $employees = \App\Employee::where('status', 'Active')->get();

        //Delete all Can Act Records
        $deleteCompletedEmployeeCredentials = \App\Employee_Credential::where('status', 'complete')->delete(); 


        foreach ($employees as $employee) {
            $url = 'http://api.targetsolutions.com/v1/users/'.$employee->id.'/credentials?status=complete';

            //dd($url);
            
            $request = $client->get($url);
            $response = $request->getBody();
            $credentials = (json_decode($response, true));


            if (array_key_exists('credentials',$credentials)) { // Before enter Foreach, make sure there are credentils
                  
            foreach ($credentials['credentials'] as $row) {
                //$employeeUpdate = \App\Employee::find($employee->id);
                //dd($url);
                if ($row['expirationdate'] == '') {
                    $expiry = null;
                } else {
                    $expiry = Carbon::parse($row['expirationdate'])->format('Y-m-d');
                }
        
                \App\Employee_Credential::Create(
                    [   'employee_id' => $employee->id,
                        'credential_id' => $row['credentialid'],
                        'date_expiration' => $expiry,
                        'status' => $row['status']
                    ] );
            }
        }
        }
        return response()->json(['success'=>'Employees Credentials - Complete successfully added']);
    }
}
