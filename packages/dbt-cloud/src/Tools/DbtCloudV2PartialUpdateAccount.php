<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Partial Update Account.
 *
 * Maps to the official dbt Cloud v2 endpoint patch /api/v2/accounts/{account_id}/.
 */
class DbtCloudV2PartialUpdateAccount extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_partial_update_account';
    protected const DESCRIPTION = 'Partial Update Account

Official dbt Cloud v2 endpoint: PATCH /api/v2/accounts/{account_id}/

Partial Account update';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
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
    protected const PATH = '/api/v2/accounts/{account_id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
