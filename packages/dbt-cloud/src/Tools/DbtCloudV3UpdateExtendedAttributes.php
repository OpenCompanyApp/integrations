<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Extended Attributes.
 *
 * Maps to the official dbt Cloud v3 endpoint patch /api/v3/accounts/{account_id}/projects/{project_id}/extended-attributes/{id}/.
 */
class DbtCloudV3UpdateExtendedAttributes extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_extended_attributes';
    protected const DESCRIPTION = 'Update Extended Attributes

Official dbt Cloud v3 endpoint: PATCH /api/v3/accounts/{account_id}/projects/{project_id}/extended-attributes/{id}/

Update an existing Extended Attributes record by ID.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/extended-attributes/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
