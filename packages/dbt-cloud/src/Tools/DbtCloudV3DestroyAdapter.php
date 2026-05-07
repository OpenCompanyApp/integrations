<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Adapter.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/projects/{project_id}/adapters/{id}/.
 */
class DbtCloudV3DestroyAdapter extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_adapter';
    protected const DESCRIPTION = 'Destroy Adapter

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/projects/{project_id}/adapters/{id}/

Delete an adapter.';
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
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/adapters/{id}/';
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
