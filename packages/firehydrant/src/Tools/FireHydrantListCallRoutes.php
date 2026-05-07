<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List call routes.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/call_routes.
 */
class FireHydrantListCallRoutes extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_call_routes';
    protected const DESCRIPTION = 'List call routes

Official FireHydrant endpoint: GET /v1/signals/call_routes

List call routes for the organization';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/call_routes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
