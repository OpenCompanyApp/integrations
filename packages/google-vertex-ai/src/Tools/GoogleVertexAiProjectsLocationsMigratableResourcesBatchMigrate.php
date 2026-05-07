<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Migratable Resources Batch Migrate.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/migratableResources:batchMigrate.
 */
class GoogleVertexAiProjectsLocationsMigratableResourcesBatchMigrate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_migratable_resources_batch_migrate';
    protected const DESCRIPTION = 'Projects Locations Migratable Resources Batch Migrate

Official Vertex AI endpoint: POST /v1/{+parent}/migratableResources:batchMigrate
Batch migrates resources from ml.googleapis.com, automl.googleapis.com, and datalabeling.googleapis.com to Vertex AI.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1BatchMigrateResourcesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/migratableResources:batchMigrate';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
