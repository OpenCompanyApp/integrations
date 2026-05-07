<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Groups Features Batch Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/features:batchCreate.
 */
class GoogleVertexAiProjectsLocationsFeatureGroupsFeaturesBatchCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_groups_features_batch_create';
    protected const DESCRIPTION = 'Projects Locations Feature Groups Features Batch Create

Official Vertex AI endpoint: POST /v1/{+parent}/features:batchCreate
Creates a batch of Features in a given FeatureGroup.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1BatchCreateFeaturesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/features:batchCreate';
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
