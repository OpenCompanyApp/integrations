<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dataquality Delete Monitor.
 *
 * Maps to the official Databricks SDK endpoint delete /api/data-quality/v1/monitors/{object_type}/{object_id}.
 */
class DatabricksDataqualityDeleteMonitor extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dataquality_delete_monitor';
    protected const DESCRIPTION = 'Dataquality Delete Monitor

Official Databricks SDK endpoint: DELETE /api/data-quality/v1/monitors/{object_type}/{object_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'object_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object_type` from the Databricks SDK endpoint.',
  ),
  'object_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `object_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/data-quality/v1/monitors/{object_type}/{object_id}';
    protected const PATH_PARAMS = array (
  'object_type' => 'object_type',
  'object_id' => 'object_id',
);
}
