<?php namespace PiCam\Http\Controllers;

use PiCam\Http\Requests;
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

}
