<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * creates an shadow configuration.
 *
 * Maps to the official Rootly endpoint post /v1/schedules/{schedule_id}/on_call_shadows.
 */
class RootlyCreateOnCallShadow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_on_call_shadow';
    protected const DESCRIPTION = 'creates an shadow configuration

Official Rootly endpoint: POST /v1/schedules/{schedule_id}/on_call_shadows

Creates a new on call shadow configuration from provided data';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/schedules/{schedule_id}/on_call_shadows';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
