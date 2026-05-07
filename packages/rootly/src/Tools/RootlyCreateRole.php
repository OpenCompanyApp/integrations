<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a role.
 *
 * Maps to the official Rootly endpoint post /v1/roles.
 */
class RootlyCreateRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_role';
    protected const DESCRIPTION = 'Creates a role

Official Rootly endpoint: POST /v1/roles

Creates a new role from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
