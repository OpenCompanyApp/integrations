<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Operations List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/{+name}/operations.
 */
class GeminiTunedModelsOperationsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_operations_list';
    protected const DESCRIPTION = 'Tuned Models Operations List

Official Google Gemini endpoint: GET /v1beta/{+name}/operations
Lists operations that match the specified filter in the request. If the server doesn\'t support this method, it returns `UNIMPLEMENTED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageToken, pageSize, filter, returnPartialSuccess.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The standard list page token.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The standard list page size.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The standard list filter.',
  ),
  'returnPartialSuccess' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to `true`, operations that are reachable are returned as normal, and those that are unreachable are returned in the ListOperationsResponse.unreachable field. This can only be `true` when reading across collections. For example, when `parent` is set to `"projects/example/locations/-"`. This field is not supported by default and will result in an `UNIMPLEMENTED` error if set unless explicitly documented otherwise in service or product specific documentation.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/{+name}/operations';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
  2 => 'filter',
  3 => 'returnPartialSuccess',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
