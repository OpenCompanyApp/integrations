<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Retrospective Process Group.
 *
 * Maps to the official Rootly endpoint put /v1/retrospective_process_groups/{id}.
 */
class RootlyUpdateRetrospectiveProcessGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_retrospective_process_group';
    protected const DESCRIPTION = 'Update a Retrospective Process Group

Official Rootly endpoint: PUT /v1/retrospective_process_groups/{id}

Update a specific Retrospective Process Group by id';
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
    protected const PATH = '/v1/retrospective_process_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
