<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an environment.
 *
 * Maps to the official Rootly endpoint put /v1/environments/{id}.
 */
class RootlyUpdateEnvironment extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_environment';
    protected const DESCRIPTION = 'Update an environment

Official Rootly endpoint: PUT /v1/environments/{id}

Update a specific environment by id';
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
    protected const PATH = '/v1/environments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
