<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a call route.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/call_routes/{id}.
 */
class FireHydrantUpdateCallRoute extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_call_route';
    protected const DESCRIPTION = 'Update a call route

Official FireHydrant endpoint: PATCH /v1/signals/call_routes/{id}

Update a call route by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/signals/call_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
