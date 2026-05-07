<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Entity Types Delete Feature Values.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+entityType}:deleteFeatureValues.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresEntityTypesDeleteFeatureValues extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_entity_types_delete_feature_values';
    protected const DESCRIPTION = 'Projects Locations Featurestores Entity Types Delete Feature Values

Official Vertex AI endpoint: POST /v1/{+entityType}:deleteFeatureValues
Delete Feature values from Featurestore. The progress of the deletion is tracked by the returned operation. The deleted feature values are guaranteed to be invisible to subsequent read operations after the operation is marked as successfully done. If a delete feature values operation fails, the feature values returned from reads and exports may be inconsistent. If consistency is required, the caller must retry the same delete request again and wait till the new operation returned is marked as successfully done.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1DeleteFeatureValuesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+entityType}:deleteFeatureValues';
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
