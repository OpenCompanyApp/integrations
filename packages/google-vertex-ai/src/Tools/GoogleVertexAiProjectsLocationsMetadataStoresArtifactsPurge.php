<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Artifacts Purge.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/artifacts:purge.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresArtifactsPurge extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_artifacts_purge';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Artifacts Purge

Official Vertex AI endpoint: POST /v1/{+parent}/artifacts:purge
Purges Artifacts.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PurgeArtifactsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/artifacts:purge';
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
