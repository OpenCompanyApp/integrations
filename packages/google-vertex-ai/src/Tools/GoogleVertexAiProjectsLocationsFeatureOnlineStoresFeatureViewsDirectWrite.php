<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Online Stores Feature Views Direct Write.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+featureView}:directWrite.
 */
class GoogleVertexAiProjectsLocationsFeatureOnlineStoresFeatureViewsDirectWrite extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_online_stores_feature_views_direct_write';
    protected const DESCRIPTION = 'Projects Locations Feature Online Stores Feature Views Direct Write

Official Vertex AI endpoint: POST /v1/{+featureView}:directWrite
Bidirectional streaming RPC to directly write to feature values in a feature view. Requests may not have a one-to-one mapping to responses and responses may be returned out-of-order to reduce latency.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1FeatureViewDirectWriteRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+featureView}:directWrite';
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
