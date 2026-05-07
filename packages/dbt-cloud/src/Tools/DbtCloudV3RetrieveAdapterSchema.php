<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Adapter Schema.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/adapter-schema/.
 */
class DbtCloudV3RetrieveAdapterSchema extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_adapter_schema';
    protected const DESCRIPTION = 'Retrieve Adapter Schema

Official dbt Cloud v3 endpoint: GET /api/v3/adapter-schema/

"
        Fetch the schema for a given adapter. The schema will include details on available fields for connections and credentials.

        Notes:
        - salesforce_v0 is currently in beta and not available to all users.';
    protected const PARAMETERS = array (
  'adapter_version' =>
  array (
    'type' => 'string',
    'description' => 'The adapter to fetch the schema for',
    'required' => true,
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
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/adapter-schema/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'adapter_version' => 'adapter_version',
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
