<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists the alert notifications that have been sent for your account. You can filter by alert channel ID or limit to only failing notifications. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). This endpoint will return data within a 24-hour timeframe. If the `from` and `to` params are set, they must be at most 24 hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be 24 hours earlier. If only the `to` param is set we will set `from` to be 24 hours earlier. If only the `from` param is set we will consider the `to` param to be 24 hours later. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v1/alert-notifications.
 */
class ChecklyGetV1Alertnotifications extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_alertnotifications';
    protected const DESCRIPTION = 'Lists the alert notifications that have been sent for your account. You can filter by alert channel ID or limit to only failing notifications. Use the `to` and `from` parameters to specify a date range (UNIX timestamp in seconds). This endpoint will return data within a 24-hour timeframe. If the `from` and `to` params are set, they must be at most 24 hours apart. If none are set, we will consider the `to` param to be now and the `from` param to be 24 hours earlier. If only the `to` param is set we will set `from` to be 24 hours earlier. If only the `from` param is set we will consider the `to` param to be 24 hours later. Rate-limiting is applied to this endpoint, you can send 5 requests / 10 seconds at most.

Official Checkly endpoint: GET /v1/alert-notifications.';
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
      'alert_channel_id' => array (
        'type' => 'integer',
        'description' => 'Limit results to an alert channel',
        'required' => false,
      ),
      'has_failures' => array (
        'type' => 'boolean',
        'description' => 'Sending the alert notification was unsuccessful',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/alert-notifications';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
      'from' => 'from',
      'to' => 'to',
      'alertChannelId' => 'alert_channel_id',
      'hasFailures' => 'has_failures',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
