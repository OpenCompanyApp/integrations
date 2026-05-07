<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create department.
 *
 * Maps to the official Brex endpoint post /v2/departments.
 */
class BrexTeamCreateDepartment extends AbstractBrexTool
{
    protected const NAME = 'brex_team_create_department';
    protected const DESCRIPTION = 'Create department

Official Brex endpoint: POST /v2/departments

This endpoint creates a new department';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/departments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
