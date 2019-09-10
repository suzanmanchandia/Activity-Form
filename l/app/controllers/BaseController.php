<?php

class BaseController extends Controller {

	public $layout = 'layout';

	public function __construct()
	{
		if (App::environment('local')) {
			$this->beforeFilter(function()
			{
				Event::fire('clockwork.controller.start');
			});

			$this->afterFilter(function()
			{
				Event::fire('clockwork.controller.end');
			});
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * @param array $results
	 * @param int $status
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function resultResponse(array $results, $status = 200)
	{
		return Response::json(array(
			'status' => $status,
			'count' => count($results),
			'results' => $results,
			'error' => false,
		));
	}

	/**
	 * @param array $data
	 * @param int $status
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function dataResponse(array $data, $status = 200)
	{
		return Response::json(array(
			'status' => $status,
			'data' => $data,
			'error' => false,
		));
	}

	/**
	 * @param string $message
	 * @param int $status
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function successResponse($message = 'OK', $status = 200)
	{
		return Response::json(array(
			'status' => $status,
			'message' => $message,
			'error' => false,
		));
	}

	/**
	 * @param string $message
	 * @param array $errors
	 * @param int $status
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function errorResponse(array $errors = null, $status = 400)
	{
		return Response::json(array(
			'status' => $status,
			'message' => join("\n", $errors),
			'error' => true,
			'errors' => $errors
		));
	}

	/**
	 * @param int $status
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function notFoundResponse($status = 404)
	{
		return $this->errorResponse(array('The requested resource was not found.'), null, $status);
	}

	/**
	 * @param array $parameters
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function missingMethod($parameters = array())
	{
		return $this->notFoundResponse();
	}

}
