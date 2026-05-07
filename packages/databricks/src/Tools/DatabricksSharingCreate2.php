<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sharing Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/data-sharing/recipients/{recipient_name}/federation-policies.
 */
class DatabricksSharingCreate2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sharing_create_2';
    protected const DESCRIPTION = 'Sharing Create

Official Databricks SDK endpoint: POST /api/2.0/data-sharing/recipients/{recipient_name}/federation-policies

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'recipient_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `recipient_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/data-sharing/recipients/{recipient_name}/federation-policies';
    protected const PATH_PARAMS = array (
  'recipient_name' => 'recipient_name',
);
}
