<?php namespace PiCam\Http\Controllers;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use PiCam\Stream;


/**
 * This controller handels all actions related to the streaming dashboard.
 *
 * Class StreamController
 * @author Robin Bürkli <robinbuerkli at bluewin dot ch>
 * @package PiCam\Http\Controllers
 */
class StreamController extends Controller {

  public function index() {
    return view('pages/streams');
  }

  public function getRes() {
    // prepare output
    $output = array();
    $output['data'] = Stream::all();

    return Response::json($output);
  }

  public function postSave() {
    $input = Request::all();
    $output = array();

    $stream = new Stream;
    $stream->title = $input['title'];
    $stream->ip    = $input['ip'];

    $res = $stream->save();

    if($res === true) {
      $output['status'] = 'success';
    } else {
      $output['status'] = 'error';
    }

    return Response::json($output);
  }

  public function postDelete() {
    $input = Request::all();
    $output = array();

    $res = Stream::destroy($input['deleteId']);

    if($res > 0) {
      $output['status'] = 'success';
    } else {
      $output['status'] = 'error';
    }

    return Response::json($output);
  }

}
