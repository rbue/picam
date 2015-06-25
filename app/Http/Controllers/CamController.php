<?php namespace PiCam\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PiCam\Status;

/**
 * This Controller handles all actions related to the raspberry pi camera.
 *
 * Class CamController
 * @author Robin Bürkli <robinbuerkli at bluewin dot ch>
 * @package PiCam\Http\Controllers
 */
class CamController extends Controller {

  /**
   * Default action which shows the current operation mode
   * @return \Illuminate\View\View Index view
   */
	public function index() {
    // fetch the current operation mode
    $status = Status::orderby('id', 'desc')->first();

    return view('pages/dashboard', $status);
  }

  /**
   * This function fetches the data
   * @return Response json-string which indicates if the operation was successful or not
   */
  public function postChange() {
    $input = Request::all();

    // fetch mode
    $mode = strtoupper($input['mode']);
    $output = array();

    // new status
    $status = new Status();
    $status->status = $mode;

    $res = $status->save();

    // return value
    if($res === true) {
      $output['status'] = 'success';

      // do action in the shell, if we're in a productive environment
        switch($mode) {
          case 'OFF':
            echo exec('sh /var/www/picam/scripts/resetCam.sh');
            break;
          case 'STREAM':
            echo exec('sh /var/www/picam/scripts/resetCam.sh');
            echo exec('sh /var/www/picam/scripts/startStream.sh > /dev/null&');
            break;
          case 'SURVEILLANCE':
            echo exec('sh /var/www/picam/scripts/resetCam.sh');
            echo exec('sh /var/www/picam/scripts/startMotion.sh > /dev/null&');
            break;
        }
    } else {
      $output['status'] = 'error';
    }
    // set the new status
    return Response::json($output);
  }


  public function postView() {
    $input = Request::all();

    // fetch mode
    $mode = strtoupper($input['mode']);

    // detect wanted mode and render the correct view
    switch($mode) {
      case 'OFF':
        return view('parts.dashboard_off');
        break;
      case 'STREAM':
        return view('parts.dashboard_stream');
        break;
      case 'SURVEILLANCE':
        return view('parts.dashboard_surveillance');
        break;
    }
  }

  /**
   * This function iterates over the vids-directory in the laravel storage and preprocess it.
   * @return Response json-string which  contains all needed data (name and create_date for every file)
   */
  public function getArchive() {
    // preprocess file data for the table
    $data[] = array();
    $data['data'] = array(); // Initialize an empty array -> for the datatable
    $files = array();

    // get all motion files
    if($handle = opendir('videos')) {
      while(($e = readdir($handle)) !== false) {
        // check if the extension is a avi file
        if(pathinfo($e)['extension'] == 'avi') {
          $files[] = $e; // push the file for further use
        }
      }
    }

    foreach($files as $file) {
      $f_tmp = array();

      $f_tmp['name'] = $file;
      //$f_tmp['date'] = date('d.m.Y H:i', filemtime('videos/' . $file));
      $data['data'][] = $f_tmp;
    }
    return Response::json($data);
  }
}
