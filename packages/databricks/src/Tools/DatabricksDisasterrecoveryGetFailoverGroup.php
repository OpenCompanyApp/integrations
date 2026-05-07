<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Disasterrecovery Get Failover Group.
 *
 * Maps to the official Databricks SDK endpoint get /api/disaster-recovery/v1/{name}.
 */
class DatabricksDisasterrecoveryGetFailoverGroup extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_disasterrecovery_get_failover_group';
    protected const DESCRIPTION = 'Disasterrecovery Get Failover Group

Official Databricks SDK endpoint: GET /api/disaster-recovery/v1/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/disaster-recovery/v1/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
