<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a retrospective process group step.
 *
 * Maps to the official Rootly endpoint post /v1/retrospective_process_groups/{retrospective_process_group_id}/steps.
 */
class RootlyCreateRetrospectiveProcessGroupStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_retrospective_process_group_step';
    protected const DESCRIPTION = 'Creates a retrospective process group step

Official Rootly endpoint: POST /v1/retrospective_process_groups/{retrospective_process_group_id}/steps

Creates a new retrospective process group step from provided data';
    protected const PARAMETERS = array (
  'retrospective_process_group_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_process_group_id parameter.',
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
    protected const PATH = '/v1/retrospective_process_groups/{retrospective_process_group_id}/steps';
    protected const PATH_PARAMS = array (
  'retrospective_process_group_id' => 'retrospective_process_group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
