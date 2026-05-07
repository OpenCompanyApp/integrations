<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Connections.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/connections/.
 */
class DbtCloudV3ListConnections extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_connections';
    protected const DESCRIPTION = 'List Connections

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/connections/

List Connections';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'adapter_version' =>
  array (
    'type' => 'string',
    'description' => 'adapter_version parameter.',
    'enum' =>
    array (
      0 => 'apache_spark_v0',
      1 => 'databricks_spark_v0',
      2 => 'databricks_v0',
      3 => 'trino_v0',
      4 => 'snowflake_v0',
      5 => 'bigquery_v0',
      6 => 'bigquery_v1',
      7 => 'postgres_v0',
      8 => 'redshift_v0',
      9 => 'salesforce_v0',
      10 => 'synapse_v0',
      11 => 'fabric_v0',
      12 => 'athena_v0',
      13 => 'teradata_v0',
    ),
  ),
  'has_catalog_ingestion_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'has_catalog_ingestion_enabled parameter.',
  ),
  'has_cost_insights_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'has_cost_insights_enabled parameter.',
  ),
  'has_cost_management_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'has_cost_management_enabled parameter.',
  ),
  'has_platform_metadata_credentials' =>
  array (
    'type' => 'boolean',
    'description' => 'has_platform_metadata_credentials parameter.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'offset parameter.',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Field to order results by. Prefix with \'-\' for descending order.',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'project_id_in' =>
  array (
    'type' => 'array',
    'description' => 'project_id__in parameter.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'description' => 'Filters by soft deletion state.
            <ul>
                <li>
                    <strong>"active"</strong> / <strong>1</strong>: Only active resources
                </li>
                <li>
                    <strong>"deleted"</strong> / <strong>2</strong>: Only deleted resources
                </li>
                <li>
                    <strong>"all"</strong>: All resources
                </li>
            </ul>',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/connections/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'adapter_version' => 'adapter_version',
  'has_catalog_ingestion_enabled' => 'has_catalog_ingestion_enabled',
  'has_cost_insights_enabled' => 'has_cost_insights_enabled',
  'has_cost_management_enabled' => 'has_cost_management_enabled',
  'has_platform_metadata_credentials' => 'has_platform_metadata_credentials',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'project_id__in' => 'project_id_in',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
