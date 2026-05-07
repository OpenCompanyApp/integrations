<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Accounts.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/.
 */
class DbtCloudV2ListAccounts extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_accounts';
    protected const DESCRIPTION = 'List Accounts

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/

Deprecated. Consider using the v3 API instead.';
    protected const PARAMETERS = array (
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
