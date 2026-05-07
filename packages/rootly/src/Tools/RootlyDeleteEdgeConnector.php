<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete edge connector.
 *
 * Maps to the official Rootly endpoint delete /v1/edge_connectors/{id}.
 */
class RootlyDeleteEdgeConnector extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_edge_connector';
    protected const DESCRIPTION = 'Delete edge connector

Official Rootly endpoint: DELETE /v1/edge_connectors/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Edge connector ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
