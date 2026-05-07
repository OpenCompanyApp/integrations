<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Entity Types Read Feature Values.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+entityType}:readFeatureValues.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresEntityTypesReadFeatureValues extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_entity_types_read_feature_values';
    protected const DESCRIPTION = 'Projects Locations Featurestores Entity Types Read Feature Values

Official Vertex AI endpoint: POST /v1/{+entityType}:readFeatureValues
Reads Feature values of a specific entity of an EntityType. For reading feature values of multiple entities of an EntityType, please use StreamingReadFeatureValues.';
    protected const PARAMETERS = array (
  'entityType' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entityType`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1ReadFeatureValuesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+entityType}:readFeatureValues';
    protected const PATH_PARAMS = array (
  0 => 'entityType',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'entityType',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
