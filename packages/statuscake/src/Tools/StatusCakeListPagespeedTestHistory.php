<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of pagespeed check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`. Aggregated data over the specified duration is returned in the root level `metadata` field..
 *
 * Maps to the official StatusCake endpoint GET /pagespeed/{test_id}/history.
 */
class StatusCakeListPagespeedTestHistory extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_pagespeed_test_history';
    protected const DESCRIPTION = 'Returns a list of pagespeed check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`. Aggregated data over the specified duration is returned in the root level `metadata` field.

Official StatusCake endpoint: GET /pagespeed/{test_id}/history.';
    protected const PARAMETERS = array (
      'test_id' => array (
        'type' => 'string',
        'description' => 'Pagespeed check ID',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of results to return from the series',
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
    protected const PATH = '/pagespeed/{test_id}/history';
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
