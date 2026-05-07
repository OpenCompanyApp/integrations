<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete SCIM token.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/scim-config/tokens/{id}/.
 */
class DbtCloudV3DeleteScimToken extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_scim_token';
    protected const DESCRIPTION = 'Delete SCIM token

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/scim-config/tokens/{id}/

Delete the specified SCIM token';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim-config/tokens/{id}/';
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
