<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an On-Call Role.
 *
 * Maps to the official Rootly endpoint get /v1/on_call_roles/{id}.
 */
class RootlyGetOnCallRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_on_call_role';
    protected const DESCRIPTION = 'Retrieves an On-Call Role

Official Rootly endpoint: GET /v1/on_call_roles/{id}

Retrieves a specific On-Call Role by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/on_call_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
