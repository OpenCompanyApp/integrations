<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Lineage Integrations.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/.
 */
class DbtCloudV3ListLineageIntegrations extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_lineage_integrations';
    protected const DESCRIPTION = 'List Lineage Integrations

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
