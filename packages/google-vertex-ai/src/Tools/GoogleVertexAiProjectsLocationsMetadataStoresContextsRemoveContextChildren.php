<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Contexts Remove Context Children.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+context}:removeContextChildren.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresContextsRemoveContextChildren extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_contexts_remove_context_children';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Contexts Remove Context Children

Official Vertex AI endpoint: POST /v1/{+context}:removeContextChildren
Remove a set of children contexts from a parent Context. If any of the child Contexts were NOT added to the parent Context, they are simply skipped.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1RemoveContextChildrenRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+context}:removeContextChildren';
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
