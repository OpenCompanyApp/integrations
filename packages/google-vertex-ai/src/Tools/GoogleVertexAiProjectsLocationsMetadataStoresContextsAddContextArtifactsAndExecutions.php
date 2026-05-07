<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Contexts Add Context Artifacts And Executions.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+context}:addContextArtifactsAndExecutions.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresContextsAddContextArtifactsAndExecutions extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_contexts_add_context_artifacts_and_executions';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Contexts Add Context Artifacts And Executions

Official Vertex AI endpoint: POST /v1/{+context}:addContextArtifactsAndExecutions
Adds a set of Artifacts and Executions to a Context. If any of the Artifacts or Executions have already been added to a Context, they are simply skipped.';
    protected const PARAMETERS = array (
  'context' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `context`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1AddContextArtifactsAndExecutionsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+context}:addContextArtifactsAndExecutions';
    protected const PATH_PARAMS = array (
  0 => 'context',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'context',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
