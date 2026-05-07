<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List webhooks.
 *
 * Maps to the official FireHydrant endpoint get /v1/webhooks.
 */
class FireHydrantListWebhooks extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_webhooks';
    protected const DESCRIPTION = 'List webhooks

Official FireHydrant endpoint: GET /v1/webhooks

Lists webhooks';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
