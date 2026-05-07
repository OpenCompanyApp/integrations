<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of uptime check alerts for a given id. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`..
 *
 * Maps to the official StatusCake endpoint GET /uptime/{test_id}/alerts.
 */
class StatusCakeListUptimeTestAlerts extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_uptime_test_alerts';
    protected const DESCRIPTION = 'Returns a list of uptime check alerts for a given id. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`.

Official StatusCake endpoint: GET /uptime/{test_id}/alerts.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Uptime check ID',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of uptime alerts to return per page',
        'required' => false,
      ),
      'before' => array (
        'type' => 'integer',
        'description' => 'Only alerts triggered before this UNIX timestamp will be returned',
        'required' => false,
      ),
      'after' => array (
        'type' => 'integer',
        'description' => 'Only alerts triggered after this UNIX timestamp will be returned',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/uptime/{test_id}/alerts';
    protected const PATH_PARAMS = array (
      'test_id' => 'test_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'before' => 'before',
      'after' => 'after',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
