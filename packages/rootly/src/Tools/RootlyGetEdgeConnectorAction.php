<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Show edge connector action.
 *
 * Maps to the official Rootly endpoint get /v1/edge_connectors/{edge_connector_id}/actions/{id}.
 */
class RootlyGetEdgeConnectorAction extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_edge_connector_action';
    protected const DESCRIPTION = 'Show edge connector action

Official Rootly endpoint: GET /v1/edge_connectors/{edge_connector_id}/actions/{id}';
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
);
    protected const METHOD = 'get';
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
