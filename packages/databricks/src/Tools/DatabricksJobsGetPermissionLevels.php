<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Jobs Get Permission Levels.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/jobs/{job_id}/permissionLevels.
 */
class DatabricksJobsGetPermissionLevels extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_jobs_get_permission_levels';
    protected const DESCRIPTION = 'Jobs Get Permission Levels

Official Databricks SDK endpoint: GET /api/2.0/permissions/jobs/{job_id}/permissionLevels

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/jobs/{job_id}/permissionLevels';
    protected const PATH_PARAMS = array (
  'job_id' => 'job_id',
);
}
