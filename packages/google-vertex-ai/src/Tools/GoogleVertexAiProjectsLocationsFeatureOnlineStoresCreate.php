<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Online Stores Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/featureOnlineStores.
 */
class GoogleVertexAiProjectsLocationsFeatureOnlineStoresCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_online_stores_create';
    protected const DESCRIPTION = 'Projects Locations Feature Online Stores Create

Official Vertex AI endpoint: POST /v1/{+parent}/featureOnlineStores
Creates a new FeatureOnlineStore in a given project and location.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: featureOnlineStoreId.',
  ),
  'featureOnlineStoreId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `featureOnlineStoreId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1FeatureOnlineStore` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/featureOnlineStores';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'featureOnlineStoreId',
);
    protected const BODY_REQUIRED = true;
}
