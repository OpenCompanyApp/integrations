<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/policy-families/{policy_family_id}.
 */
class DatabricksComputeGet5 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_get_5';
    protected const DESCRIPTION = 'Compute Get

Official Databricks SDK endpoint: GET /api/2.0/policy-families/{policy_family_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'policy_family_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policy_family_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/policy-families/{policy_family_id}';
    protected const PATH_PARAMS = array (
  'policy_family_id' => 'policy_family_id',
);
}
