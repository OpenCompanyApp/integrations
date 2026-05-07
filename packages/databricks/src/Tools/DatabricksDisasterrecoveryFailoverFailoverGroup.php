<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Disasterrecovery Failover Failover Group.
 *
 * Maps to the official Databricks SDK endpoint post /api/disaster-recovery/v1/{name}/failover.
 */
class DatabricksDisasterrecoveryFailoverFailoverGroup extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_disasterrecovery_failover_failover_group';
    protected const DESCRIPTION = 'Disasterrecovery Failover Failover Group

Official Databricks SDK endpoint: POST /api/disaster-recovery/v1/{name}/failover

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
    protected const METHOD = 'post';
    protected const PATH = '/api/disaster-recovery/v1/{name}/failover';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
