<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List secrets.
 *
 * Maps to the official Rootly endpoint get /v1/secrets.
 */
class RootlyListSecrets extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_secrets';
    protected const DESCRIPTION = 'List secrets

Official Rootly endpoint: GET /v1/secrets

List secrets';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/secrets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
