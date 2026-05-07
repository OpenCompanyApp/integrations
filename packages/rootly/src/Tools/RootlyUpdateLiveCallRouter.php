<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Live Call Router.
 *
 * Maps to the official Rootly endpoint put /v1/live_call_routers/{id}.
 */
class RootlyUpdateLiveCallRouter extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_live_call_router';
    protected const DESCRIPTION = 'Update a Live Call Router

Official Rootly endpoint: PUT /v1/live_call_routers/{id}

Update a specific Live Call Router by id';
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
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/live_call_routers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
