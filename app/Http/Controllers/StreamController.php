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

  /**
   * This function renders the streaming index page
   * @return \Illuminate\View\View default home
   */
  public function index() {
    return view('pages/streams');
  }

  /**
   * This functions fetches all remote streams from the database and pass them as json-string.
   * @return Response json-string with all remote streams
   */
  public function getRes() {
    // prepare output
    $output = array();
    $output['data'] = Stream::all();

    return Response::json($output);
  }

  /**
   * This functions saves the new stream.
   * @return Response json-string, which indicates if the operation was successful or not
   */
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

  /**
   * This function deletes a stream.
   * @return Response json-string, which indicates if the operation was successful or not
   */
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
