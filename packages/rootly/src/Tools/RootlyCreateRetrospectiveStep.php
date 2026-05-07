<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a retrospective step.
 *
 * Maps to the official Rootly endpoint post /v1/retrospective_processes/{retrospective_process_id}/retrospective_steps.
 */
class RootlyCreateRetrospectiveStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_retrospective_step';
    protected const DESCRIPTION = 'Creates a retrospective step

Official Rootly endpoint: POST /v1/retrospective_processes/{retrospective_process_id}/retrospective_steps

Creates a new retrospective step from provided data';
    protected const PARAMETERS = array (
  'retrospective_process_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_process_id parameter.',
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
    protected const PATH = '/v1/retrospective_processes/{retrospective_process_id}/retrospective_steps';
    protected const PATH_PARAMS = array (
  'retrospective_process_id' => 'retrospective_process_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
