<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List collections from BI tool_2.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/collections/{collection_id}/.
 */
class DbtCloudV3ListCollectionsFromBiTool2 extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_collections_from_bi_tool_2';
    protected const DESCRIPTION = 'List collections from BI tool_2

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/collections/{collection_id}/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'collection_id' =>
  array (
    'type' => 'string',
    'description' => 'collection_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/collections/{collection_id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'collection_id' => 'collection_id',
  'id' => 'id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
