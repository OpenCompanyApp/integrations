<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Extended Attributes.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/projects/{project_id}/extended-attributes/{id}/.
 */
class DbtCloudV3DestroyExtendedAttributes extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_extended_attributes';
    protected const DESCRIPTION = 'Destroy Extended Attributes

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/projects/{project_id}/extended-attributes/{id}/

Delete an existing Extended Attributes record by ID.';
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
);
    protected const METHOD = 'delete';
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
    protected const BODY_REQUIRED = false;
}
