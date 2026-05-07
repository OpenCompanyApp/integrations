<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Disasterrecovery List Failover Groups.
 *
 * Maps to the official Databricks SDK endpoint get /api/disaster-recovery/v1/{parent}/failover-groups.
 */
class DatabricksDisasterrecoveryListFailoverGroups extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_disasterrecovery_list_failover_groups';
    protected const DESCRIPTION = 'Disasterrecovery List Failover Groups

Official Databricks SDK endpoint: GET /api/disaster-recovery/v1/{parent}/failover-groups

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/disaster-recovery/v1/{parent}/failover-groups';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
