<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List departments.
 *
 * Maps to the official Brex endpoint get /v2/departments.
 */
class BrexTeamListDepartments extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_departments';
    protected const DESCRIPTION = 'List departments

Official Brex endpoint: GET /v2/departments

This endpoint lists all departments.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/departments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
