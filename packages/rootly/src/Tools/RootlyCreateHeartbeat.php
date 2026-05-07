<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a heartbeat.
 *
 * Maps to the official Rootly endpoint post /v1/heartbeats.
 */
class RootlyCreateHeartbeat extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_heartbeat';
    protected const DESCRIPTION = 'Creates a heartbeat

Official Rootly endpoint: POST /v1/heartbeats

Creates a new heartbeat from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/heartbeats';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
