<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Live Call Router.
 *
 * Maps to the official Rootly endpoint get /v1/live_call_routers/{id}.
 */
class RootlyGetLiveCallRouter extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_live_call_router';
    protected const DESCRIPTION = 'Retrieves a Live Call Router

Official Rootly endpoint: GET /v1/live_call_routers/{id}

Retrieves a specific Live Call Router by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/live_call_routers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
