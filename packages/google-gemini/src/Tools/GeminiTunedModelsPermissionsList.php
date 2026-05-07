<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Permissions List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+parent}/permissions.
 */
class GeminiTunedModelsPermissionsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_permissions_list';
    protected const DESCRIPTION = 'Tuned Models Permissions List

Official Google Gemini endpoint: GET /v1beta/{+parent}/permissions
Lists permissions for the specific resource.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Gemini API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous `ListPermissions` call. Provide the `page_token` returned by one request as an argument to the next request to retrieve the next page. When paginating, all other parameters provided to `ListPermissions` must match the call that provided the page token.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of `Permission`s to return (per page). The service may return fewer permissions. If unspecified, at most 10 permissions will be returned. This method returns at most 1000 permissions per page, even if you pass larger page_size.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/{+parent}/permissions';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
