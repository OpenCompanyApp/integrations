<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/tunedModels.
 */
class GeminiTunedModelsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_list';
    protected const DESCRIPTION = 'Tuned Models List

Official Google Gemini endpoint: GET /v1beta/tunedModels
Lists created tuned models.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageToken, pageSize, filter.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous `ListTunedModels` call. Provide the `page_token` returned by one request as an argument to the next request to retrieve the next page. When paginating, all other parameters provided to `ListTunedModels` must match the call that provided the page token.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of `TunedModels` to return (per page). The service may return fewer tuned models. If unspecified, at most 10 tuned models will be returned. This method returns at most 1000 models per page, even if you pass a larger page_size.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A filter is a full text search over the tuned model\'s description and display name. By default, results will not include tuned models shared with everyone. Additional operators: - owner:me - writers:me - readers:me - readers:everyone Examples: "owner:me" returns all tuned models to which caller has owner role "readers:me" returns all tuned models to which caller has reader role "readers:everyone" returns all tuned models that are shared with everyone',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/tunedModels';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
  2 => 'filter',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
