<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a call route.
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/call_routes/{id}.
 */
class FireHydrantDeleteCallRoute extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_call_route';
    protected const DESCRIPTION = 'Delete a call route

Official FireHydrant endpoint: DELETE /v1/signals/call_routes/{id}

Delete a call route by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
