<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update edge connector.
 *
 * Maps to the official Rootly endpoint patch /v1/edge_connectors/{id}.
 */
class RootlyUpdateEdgeConnector extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_edge_connector';
    protected const DESCRIPTION = 'Update edge connector

Official Rootly endpoint: PATCH /v1/edge_connectors/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Edge connector ID',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'patch';
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
