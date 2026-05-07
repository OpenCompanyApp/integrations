<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update RetrospectiveProcessGroup Step.
 *
 * Maps to the official Rootly endpoint put /v1/retrospective_process_group_steps/{id}.
 */
class RootlyUpdateRetrospectiveProcessGroupStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_retrospective_process_group_step';
    protected const DESCRIPTION = 'Update RetrospectiveProcessGroup Step

Official Rootly endpoint: PUT /v1/retrospective_process_group_steps/{id}

Update a specific RetrospectiveProcessGroup Step by id';
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
    protected const PATH = '/v1/retrospective_process_group_steps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
