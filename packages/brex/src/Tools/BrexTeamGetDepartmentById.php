<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get department.
 *
 * Maps to the official Brex endpoint get /v2/departments/{id}.
 */
class BrexTeamGetDepartmentById extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_department_by_id';
    protected const DESCRIPTION = 'Get department

Official Brex endpoint: GET /v2/departments/{id}

This endpoint gets a department by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/departments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
