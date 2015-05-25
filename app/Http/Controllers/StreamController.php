<?php namespace PiCam\Http\Controllers;

use PiCam\Http\Requests;


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

}
