<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Feature Groups Get Iam Policy.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+resource}:getIamPolicy.
 */
class GoogleVertexAiProjectsLocationsFeatureGroupsGetIamPolicy extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_feature_groups_get_iam_policy';
    protected const DESCRIPTION = 'Projects Locations Feature Groups Get Iam Policy

Official Vertex AI endpoint: POST /v1/{+resource}:getIamPolicy
Gets the access control policy for a resource. Returns an empty policy if the resource exists and does not have a policy set.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: options.requestedPolicyVersion.',
  ),
  'options.requestedPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `options.requestedPolicyVersion`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resource}:getIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
  0 => 'options.requestedPolicyVersion',
);
    protected const BODY_REQUIRED = false;
}
