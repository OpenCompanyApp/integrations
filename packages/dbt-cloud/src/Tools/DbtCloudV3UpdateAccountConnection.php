<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Account Connection.
 *
 * Maps to the official dbt Cloud v3 endpoint patch /api/v3/accounts/{account_id}/connections/{id}/.
 */
class DbtCloudV3UpdateAccountConnection extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_account_connection';
    protected const DESCRIPTION = 'Update Account Connection

Official dbt Cloud v3 endpoint: PATCH /api/v3/accounts/{account_id}/connections/{id}/

Update an existing Account Connection.';
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
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v3/accounts/{account_id}/connections/{id}/';
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
