<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Account Connections.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/connections/.
 */
class DbtCloudV3ListAccountConnections extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_account_connections';
    protected const DESCRIPTION = 'List Account Connections

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/connections/

List all Account Connections.';
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
    'description' => 'The adapter to fetch the connections for',
    'enum' =>
    array (
      0 => 'apache_spark_v0',
      1 => 'athena_v0',
      2 => 'bigquery_v0',
      3 => 'bigquery_v1',
      4 => 'databricks_spark_v0',
      5 => 'databricks_v0',
      6 => 'fabric_v0',
      7 => 'postgres_v0',
      8 => 'redshift_v0',
      9 => 'salesforce_v0',
      10 => 'snowflake_v0',
      11 => 'synapse_v0',
      12 => 'teradata_v0',
      13 => 'trino_v0',
    ),
  ),
  'has_catalog_ingestion_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'Connections with catalog ingestion enabled',
  ),
  'has_cost_insights_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'Connections with cost insights enabled',
  ),
  'has_cost_management_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'Connections with cost management enabled',
  ),
  'has_platform_metadata_credentials' =>
  array (
    'type' => 'boolean',
    'description' => 'Connections with platform metadata credentials',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'The maximum number of items to return.',
  ),
  'name_icontains' =>
  array (
    'type' => 'string',
    'description' => 'Connection\'s name, case-insensitive',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'The number of items to skip before starting to collect the result set.',
  ),
  'private_endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter by private endpoint ID',
  ),
  'requires_platform_metadata_credentials' =>
  array (
    'type' => 'boolean',
    'description' => 'Filter connections by Platform Metadata Credentials status with warehouse account deduplication. True=connections that need Platform Metadata Credentials, False=connections that have direct Platform Metadata Credentials only. Returns one connection per unique warehouse account (the one with most environments).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/connections/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'adapter_version' => 'adapter_version',
  'has_catalog_ingestion_enabled' => 'has_catalog_ingestion_enabled',
  'has_cost_insights_enabled' => 'has_cost_insights_enabled',
  'has_cost_management_enabled' => 'has_cost_management_enabled',
  'has_platform_metadata_credentials' => 'has_platform_metadata_credentials',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'name__icontains' => 'name_icontains',
  'offset' => 'offset',
  'private_endpoint_id' => 'private_endpoint_id',
  'requires_platform_metadata_credentials' => 'requires_platform_metadata_credentials',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
