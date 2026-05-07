<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Set.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/permissions/{request_object_type}/{request_object_id}.
 */
class DatabricksIamSet extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_set';
    protected const DESCRIPTION = 'Iam Set

Official Databricks SDK endpoint: PUT /api/2.0/permissions/{request_object_type}/{request_object_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'request_object_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `request_object_type` from the Databricks SDK endpoint.',
  ),
  'request_object_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `request_object_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/permissions/{request_object_type}/{request_object_id}';
    protected const PATH_PARAMS = array (
  'request_object_type' => 'request_object_type',
  'request_object_id' => 'request_object_id',
);
}
