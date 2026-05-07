<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Accounts.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/.
 */
class DbtCloudV3ListAccounts extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_accounts';
    protected const DESCRIPTION = 'List Accounts

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/

List the Accounts that your API Token is authorized to access.';
    protected const PARAMETERS = array (
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
