<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sharing Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/unity-catalog/providers.
 */
class DatabricksSharingCreate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sharing_create';
    protected const DESCRIPTION = 'Sharing Create

Official Databricks SDK endpoint: POST /api/2.1/unity-catalog/providers

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/2.1/unity-catalog/providers';
    protected const PATH_PARAMS = array (
);
}
