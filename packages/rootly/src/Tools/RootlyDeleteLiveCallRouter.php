<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Live Call Router.
 *
 * Maps to the official Rootly endpoint delete /v1/live_call_routers/{id}.
 */
class RootlyDeleteLiveCallRouter extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_live_call_router';
    protected const DESCRIPTION = 'Delete a Live Call Router

Official Rootly endpoint: DELETE /v1/live_call_routers/{id}

Delete a specific Live Call Router by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
