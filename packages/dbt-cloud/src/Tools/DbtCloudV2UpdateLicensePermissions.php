<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update License Permissions.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/permissions/{id}/.
 */
class DbtCloudV2UpdateLicensePermissions extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_update_license_permissions';
    protected const DESCRIPTION = 'Update License Permissions

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/permissions/{id}/';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/accounts/{account_id}/permissions/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
