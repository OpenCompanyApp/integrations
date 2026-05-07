<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy License Map.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/license-maps/{id}/.
 */
class DbtCloudV3DestroyLicenseMap extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_license_map';
    protected const DESCRIPTION = 'Destroy License Map

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/license-maps/{id}/';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/license-maps/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
