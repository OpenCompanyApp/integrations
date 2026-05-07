<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Show edge connector.
 *
 * Maps to the official Rootly endpoint get /v1/edge_connectors/{id}.
 */
class RootlyGetEdgeConnector extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_edge_connector';
    protected const DESCRIPTION = 'Show edge connector

Official Rootly endpoint: GET /v1/edge_connectors/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Edge connector ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/edge_connectors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
