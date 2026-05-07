<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a retrospective step.
 *
 * Maps to the official Rootly endpoint put /v1/retrospective_steps/{id}.
 */
class RootlyUpdateRetrospectiveStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_retrospective_step';
    protected const DESCRIPTION = 'Update a retrospective step

Official Rootly endpoint: PUT /v1/retrospective_steps/{id}

Update a specific retrospective step by id';
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
    protected const PATH = '/v1/retrospective_steps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
