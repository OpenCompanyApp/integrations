<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all alerts that have been sent for your account. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). This endpoint will return data within a 6-hour timeframe. If the `from` and `to` params are set, they must be at most 6 hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be 6 hours earlier. If only the `to` param is set we will set `from` to be 6 hours earlier. If only the `from` param is set we will consider the `to` param to be 6 hours later..
 *
 * Maps to the official Checkly endpoint GET /v1/check-alerts.
 */
class ChecklyGetV1Checkalerts extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkalerts';
    protected const DESCRIPTION = 'Lists all alerts that have been sent for your account. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). This endpoint will return data within a 6-hour timeframe. If the `from` and `to` params are set, they must be at most 6 hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be 6 hours earlier. If only the `to` param is set we will set `from` to be 6 hours earlier. If only the `from` param is set we will consider the `to` param to be 6 hours later.

Official Checkly endpoint: GET /v1/check-alerts.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Select records up from this UNIX timestamp (>= date). Defaults to now - 6 hours.',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Optional. Select records up to this UNIX timestamp (< date). Defaults to 6 hours after "from".',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
      'from' => 'from',
      'to' => 'to',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
