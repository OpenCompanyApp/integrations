<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Live Call Router.
 *
 * Maps to the official Rootly endpoint post /v1/live_call_routers.
 */
class RootlyCreateLiveCallRouter extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_live_call_router';
    protected const DESCRIPTION = 'Creates a Live Call Router

Official Rootly endpoint: POST /v1/live_call_routers

Creates a new Live Call Router from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/live_call_routers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
