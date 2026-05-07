<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a retrospective process.
 *
 * Maps to the official Rootly endpoint put /v1/retrospective_processes/{id}.
 */
class RootlyUpdateRetrospectiveProcess extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_retrospective_process';
    protected const DESCRIPTION = 'Update a retrospective process

Official Rootly endpoint: PUT /v1/retrospective_processes/{id}

Updates a specific retrospective process by id';
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
    protected const PATH = '/v1/retrospective_processes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
