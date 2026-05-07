<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Online Stores Feature Views Fetch Feature Values.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+featureView}:fetchFeatureValues.
 */
class GoogleVertexAiProjectsLocationsFeatureOnlineStoresFeatureViewsFetchFeatureValues extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_online_stores_feature_views_fetch_feature_values';
    protected const DESCRIPTION = 'Projects Locations Feature Online Stores Feature Views Fetch Feature Values

Official Vertex AI endpoint: POST /v1/{+featureView}:fetchFeatureValues
Fetch feature values under a FeatureView.';
    protected const PARAMETERS = array (
  'featureView' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `featureView`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1FetchFeatureValuesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+featureView}:fetchFeatureValues';
    protected const PATH_PARAMS = array (
  0 => 'featureView',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'featureView',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
