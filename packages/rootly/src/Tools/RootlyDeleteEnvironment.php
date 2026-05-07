<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an environment.
 *
 * Maps to the official Rootly endpoint delete /v1/environments/{id}.
 */
class RootlyDeleteEnvironment extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_environment';
    protected const DESCRIPTION = 'Delete an environment

Official Rootly endpoint: DELETE /v1/environments/{id}

Delete a specific environment by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/environments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
