<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Create edge connector action.
 *
 * Maps to the official Rootly endpoint post /v1/edge_connectors/{edge_connector_id}/actions.
 */
class RootlyCreateEdgeConnectorAction extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_edge_connector_action';
    protected const DESCRIPTION = 'Create edge connector action

Official Rootly endpoint: POST /v1/edge_connectors/{edge_connector_id}/actions';
    protected const PARAMETERS = array (
  'edge_connector_id' =>
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/edge_connectors/{edge_connector_id}/actions';
    protected const PATH_PARAMS = array (
  'edge_connector_id' => 'edge_connector_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
