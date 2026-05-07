<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Create edge connector.
 *
 * Maps to the official Rootly endpoint post /v1/edge_connectors.
 */
class RootlyCreateEdgeConnector extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_edge_connector';
    protected const DESCRIPTION = 'Create edge connector

Official Rootly endpoint: POST /v1/edge_connectors';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/edge_connectors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
