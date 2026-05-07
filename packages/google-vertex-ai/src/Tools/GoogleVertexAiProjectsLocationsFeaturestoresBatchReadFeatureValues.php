<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Batch Read Feature Values.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+featurestore}:batchReadFeatureValues.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresBatchReadFeatureValues extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_batch_read_feature_values';
    protected const DESCRIPTION = 'Projects Locations Featurestores Batch Read Feature Values

Official Vertex AI endpoint: POST /v1/{+featurestore}:batchReadFeatureValues
Batch reads Feature values from a Featurestore. This API enables batch reading Feature values, where each read instance in the batch may read Feature values of entities from one or more EntityTypes. Point-in-time correctness is guaranteed for Feature values of each read instance as of each instance\'s read timestamp.';
    protected const PARAMETERS = array (
  'featurestore' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `featurestore`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1BatchReadFeatureValuesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+featurestore}:batchReadFeatureValues';
    protected const PATH_PARAMS = array (
  0 => 'featurestore',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'featurestore',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
