<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dataquality Cancel Refresh.
 *
 * Maps to the official Databricks SDK endpoint post /api/data-quality/v1/monitors/{object_type}/{object_id}/refreshes/{refresh_id}/cancel.
 */
class DatabricksDataqualityCancelRefresh extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dataquality_cancel_refresh';
    protected const DESCRIPTION = 'Dataquality Cancel Refresh

Official Databricks SDK endpoint: POST /api/data-quality/v1/monitors/{object_type}/{object_id}/refreshes/{refresh_id}/cancel

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
  'refresh_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `refresh_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/data-quality/v1/monitors/{object_type}/{object_id}/refreshes/{refresh_id}/cancel';
    protected const PATH_PARAMS = array (
  'object_type' => 'object_type',
  'object_id' => 'object_id',
  'refresh_id' => 'refresh_id',
);
}
