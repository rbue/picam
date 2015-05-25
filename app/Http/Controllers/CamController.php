<?php namespace PiCam\Http\Controllers;

use PiCam\Http\Requests;

/**
 * This Controller handles all actions related to the raspberry pi camera.
 *
 * Class CamController
 * @author Robin Bürkli <robinbuerkli at bluewin dot ch>
 * @package PiCam\Http\Controllers
 */
class CamController extends Controller {

	public function index() {
    return view('pages/dashboard');
  }

}
