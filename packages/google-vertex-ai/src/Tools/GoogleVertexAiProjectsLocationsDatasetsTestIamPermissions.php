<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Datasets Test Iam Permissions.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+resource}:testIamPermissions.
 */
class GoogleVertexAiProjectsLocationsDatasetsTestIamPermissions extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_datasets_test_iam_permissions';
    protected const DESCRIPTION = 'Projects Locations Datasets Test Iam Permissions

Official Vertex AI endpoint: POST /v1/{+resource}:testIamPermissions
Returns permissions that a caller has on the specified resource. If the resource does not exist, this will return an empty set of permissions, not a `NOT_FOUND` error. Note: This operation is designed to be used for building permission-aware UIs and command-line tools, not for authorization checking. This operation may "fail open" without warning.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: permissions.',
  ),
  'permissions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `permissions`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resource}:testIamPermissions';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
  0 => 'permissions',
);
    protected const BODY_REQUIRED = false;
}
