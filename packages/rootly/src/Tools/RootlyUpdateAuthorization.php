<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an authorization.
 *
 * Maps to the official Rootly endpoint put /v1/authorizations/{id}.
 */
class RootlyUpdateAuthorization extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_authorization';
    protected const DESCRIPTION = 'Update an authorization

Official Rootly endpoint: PUT /v1/authorizations/{id}

Update a specific authorization by id';
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
    protected const PATH = '/v1/authorizations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
