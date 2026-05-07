<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Models List.
 *
 * Maps to the official Gemini endpoint GET /v1beta/models.
 */
class GeminiModelsList extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_models_list';
    protected const DESCRIPTION = 'Models List

Official Google Gemini endpoint: GET /v1beta/models
Lists the [`Model`s](https://ai.google.dev/gemini-api/docs/models/gemini) available through the Gemini API.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The maximum number of `Models` to return (per page). If unspecified, 50 models will be returned per page. This method returns at most 1000 models per page, even if you pass a larger page_size.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A page token, received from a previous `ListModels` call. Provide the `page_token` returned by one request as an argument to the next request to retrieve the next page. When paginating, all other parameters provided to `ListModels` must match the call that provided the page token.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1beta/models';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
