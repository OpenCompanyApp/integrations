<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a functionality.
 *
 * Maps to the official Rootly endpoint put /v1/functionalities/{id}.
 */
class RootlyUpdateFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_functionality';
    protected const DESCRIPTION = 'Update a functionality

Official Rootly endpoint: PUT /v1/functionalities/{id}

Update a specific functionality by id';
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
    protected const PATH = '/v1/functionalities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
