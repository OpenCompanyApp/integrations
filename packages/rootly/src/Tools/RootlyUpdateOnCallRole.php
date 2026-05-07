<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an On-Call Role.
 *
 * Maps to the official Rootly endpoint put /v1/on_call_roles/{id}.
 */
class RootlyUpdateOnCallRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_on_call_role';
    protected const DESCRIPTION = 'Update an On-Call Role

Official Rootly endpoint: PUT /v1/on_call_roles/{id}

Update a specific On-Call Role by id';
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
    protected const PATH = '/v1/on_call_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
