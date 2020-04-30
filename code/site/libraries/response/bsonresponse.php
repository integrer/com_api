<?php
class APIBSONResponse
{
    var $response = null;

    public function __construct($response) {
        $responseProp = new stdClass;

		if ($response instanceof Exception)
		{
			$responseProp->err_msg = $response->getMessage();
			$responseProp->err_code = $response->getCode();
		}
		else
		{
			$responseProp->api = "{$response->component}.{$response->resource}";
			$responseProp->response_id = $response->response_id;
			$responseProp->data = $response->get('response');
        }
        
        $this->response = $responseProp;
    }

    public function __toString() {
        return MongoDB\BSON\fromPHP($this->response);
    }
}