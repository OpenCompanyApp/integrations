<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List edge connector actions.
 *
 * Maps to the official Rootly endpoint get /v1/edge_connectors/{edge_connector_id}/actions.
 */
class RootlyListEdgeConnectorActions extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_edge_connector_actions';
    protected const DESCRIPTION = 'List edge connector actions

Official Rootly endpoint: GET /v1/edge_connectors/{edge_connector_id}/actions';
    protected const PARAMETERS = array (
  'edge_connector_id' =>
  array (
    'type' => 'string',
    'description' => 'Edge connector ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
