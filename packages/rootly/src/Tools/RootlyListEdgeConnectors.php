<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List edge connectors.
 *
 * Maps to the official Rootly endpoint get /v1/edge_connectors.
 */
class RootlyListEdgeConnectors extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_edge_connectors';
    protected const DESCRIPTION = 'List edge connectors

Official Rootly endpoint: GET /v1/edge_connectors';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'Filter by status (active/paused)',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'Filter by name (partial match)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/edge_connectors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'status' => 'status',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
