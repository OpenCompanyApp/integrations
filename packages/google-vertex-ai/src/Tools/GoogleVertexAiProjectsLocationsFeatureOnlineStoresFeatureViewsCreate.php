<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Online Stores Feature Views Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/featureViews.
 */
class GoogleVertexAiProjectsLocationsFeatureOnlineStoresFeatureViewsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_online_stores_feature_views_create';
    protected const DESCRIPTION = 'Projects Locations Feature Online Stores Feature Views Create

Official Vertex AI endpoint: POST /v1/{+parent}/featureViews
Creates a new FeatureView in a given FeatureOnlineStore.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: featureViewId, runSyncImmediately.',
  ),
  'featureViewId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `featureViewId`.',
  ),
  'runSyncImmediately' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `runSyncImmediately`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1FeatureView` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/featureViews';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'featureViewId',
  1 => 'runSyncImmediately',
);
    protected const BODY_REQUIRED = true;
}
