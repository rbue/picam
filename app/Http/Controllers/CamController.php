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

	public function index() {

    // fetch the current operation mode
    $status = Status::orderby('id', 'desc')->first();

    return view('pages/dashboard', $status);
  }

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
      if(env('APP_DEBUG') == false) {
        switch($mode) {
          case 'OFF':
            exec('sh ../scripts/resetCam.sh');
            break;
          case 'STREAM':
            exec('sh ../scripts/resetCam.sh');
            exec('sh ../scripts/startStream.sh > /dev/null&');
            break;
          case 'SURVEILLANCE':
            exec('sh ../scripts/resetCam.sh');
            exec('sh ../scripts/startMotion.sh > /dev/null&');
            break;
        }
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

  public function getArchive() {
    $files = Storage::files('vids');

    // preprocess file data for the table
    $data[] = array();
    $data['data'] = array(); // Initialize an empty array -> for the datatable
    foreach($files as $file) {
      $f_tmp = array();

      $f_tmp['name'] = explode('/', $file)[1];
      $f_tmp['date'] = date('d.m.Y H:i', Storage::lastModified($file));
      $data['data'][] = $f_tmp;
    }
    return Response::json($data);
  }
}