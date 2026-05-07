<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List webhook endpoints.
 *
 * Maps to the official Rootly endpoint get /v1/webhooks/endpoints.
 */
class RootlyListWebhooksEndpoints extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_webhooks_endpoints';
    protected const DESCRIPTION = 'List webhook endpoints

Official Rootly endpoint: GET /v1/webhooks/endpoints

List webhook endpoints';
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
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[slug]' => 'filter_slug',
  'filter[name]' => 'filter_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
