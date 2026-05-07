<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Get Iam Policy.
 *
 * Maps to the official Cloud Functions endpoint GET /v2/{+resource}:getIamPolicy.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsGetIamPolicy extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_get_iam_policy';
    protected const DESCRIPTION = 'Projects Locations Functions Get Iam Policy

Official Cloud Functions endpoint: GET /v2/{+resource}:getIamPolicy
Gets the access control policy for a resource. Returns an empty policy if the resource exists and does not have a policy set.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Functions method. Known keys: options.requestedPolicyVersion.',
  ),
  'options.requestedPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `options.requestedPolicyVersion`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+resource}:getIamPolicy';
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
