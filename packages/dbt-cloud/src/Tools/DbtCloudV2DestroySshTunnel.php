<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy SSH Tunnel.
 *
 * Maps to the official dbt Cloud v2 endpoint delete /api/v2/accounts/{account_id}/encryptions/{id}/.
 */
class DbtCloudV2DestroySshTunnel extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_destroy_ssh_tunnel';
    protected const DESCRIPTION = 'Destroy SSH Tunnel

Official dbt Cloud v2 endpoint: DELETE /api/v2/accounts/{account_id}/encryptions/{id}/

Delete an SSH tunnel';
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
    protected const PATH = '/api/v2/accounts/{account_id}/encryptions/{id}/';
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
