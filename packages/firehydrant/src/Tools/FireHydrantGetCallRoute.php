<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Retrieve a call route.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/call_routes/{id}.
 */
class FireHydrantGetCallRoute extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_call_route';
    protected const DESCRIPTION = 'Retrieve a call route

Official FireHydrant endpoint: GET /v1/signals/call_routes/{id}

Retrieve a call route by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/call_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
