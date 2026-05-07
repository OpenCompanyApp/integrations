<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create SSH Tunnel.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/encryptions/.
 */
class DbtCloudV2CreateSshTunnel extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_create_ssh_tunnel';
    protected const DESCRIPTION = 'Create SSH Tunnel

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/encryptions/

Create a new SSH tunnel to encrypt traffic for a given connection';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/accounts/{account_id}/encryptions/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
