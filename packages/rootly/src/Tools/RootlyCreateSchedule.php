<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a schedule.
 *
 * Maps to the official Rootly endpoint post /v1/schedules.
 */
class RootlyCreateSchedule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_schedule';
    protected const DESCRIPTION = 'Creates a schedule

Official Rootly endpoint: POST /v1/schedules

Creates a new schedule from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/schedules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
