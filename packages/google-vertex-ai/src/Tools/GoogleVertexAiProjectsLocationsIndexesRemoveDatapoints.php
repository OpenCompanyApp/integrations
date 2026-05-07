<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Indexes Remove Datapoints.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+index}:removeDatapoints.
 */
class GoogleVertexAiProjectsLocationsIndexesRemoveDatapoints extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_indexes_remove_datapoints';
    protected const DESCRIPTION = 'Projects Locations Indexes Remove Datapoints

Official Vertex AI endpoint: POST /v1/{+index}:removeDatapoints
Remove Datapoints from an Index.';
    protected const PARAMETERS = array (
  'index' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `index`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1RemoveDatapointsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+index}:removeDatapoints';
    protected const PATH_PARAMS = array (
  0 => 'index',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'index',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
