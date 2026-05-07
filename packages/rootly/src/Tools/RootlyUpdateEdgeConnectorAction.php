<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update edge connector action.
 *
 * Maps to the official Rootly endpoint patch /v1/edge_connectors/{edge_connector_id}/actions/{id}.
 */
class RootlyUpdateEdgeConnectorAction extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_edge_connector_action';
    protected const DESCRIPTION = 'Update edge connector action

Official Rootly endpoint: PATCH /v1/edge_connectors/{edge_connector_id}/actions/{id}';
    protected const PARAMETERS = array (
  'edge_connector_id' =>
  array (
    'type' => 'string',
    'description' => 'Edge connector ID',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/edge_connectors/{edge_connector_id}/actions/{id}';
    protected const PATH_PARAMS = array (
  'edge_connector_id' => 'edge_connector_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
