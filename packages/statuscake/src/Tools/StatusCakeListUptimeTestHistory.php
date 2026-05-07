<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of uptime check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`..
 *
 * Maps to the official StatusCake endpoint GET /uptime/{test_id}/history.
 */
class StatusCakeListUptimeTestHistory extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_uptime_test_history';
    protected const DESCRIPTION = 'Returns a list of uptime check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`.

Official StatusCake endpoint: GET /uptime/{test_id}/history.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Uptime check ID',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of results to return per page',
        'required' => false,
      ),
      'before' => array (
        'type' => 'integer',
        'description' => 'Only results created before this UNIX timestamp will be returned',
        'required' => false,
      ),
      'after' => array (
        'type' => 'integer',
        'description' => 'Only results created after this UNIX timestamp will be returned',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/uptime/{test_id}/history';
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
