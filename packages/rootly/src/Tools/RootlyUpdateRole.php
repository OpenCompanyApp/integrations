<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a role.
 *
 * Maps to the official Rootly endpoint put /v1/roles/{id}.
 */
class RootlyUpdateRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_role';
    protected const DESCRIPTION = 'Update a role

Official Rootly endpoint: PUT /v1/roles/{id}

Update a specific role by id';
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
    protected const PATH = '/v1/roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
