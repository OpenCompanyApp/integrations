<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Online Stores Feature Views Delete.
 *
 * Maps to the official Vertex AI endpoint DELETE /v1/{+name}.
 */
class GoogleVertexAiProjectsLocationsFeatureOnlineStoresFeatureViewsDelete extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_online_stores_feature_views_delete';
    protected const DESCRIPTION = 'Projects Locations Feature Online Stores Feature Views Delete

Official Vertex AI endpoint: DELETE /v1/{+name}
Deletes a single FeatureView.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
