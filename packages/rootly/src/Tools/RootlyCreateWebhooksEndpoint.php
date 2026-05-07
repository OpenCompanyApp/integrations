<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a webhook endpoint.
 *
 * Maps to the official Rootly endpoint post /v1/webhooks/endpoints.
 */
class RootlyCreateWebhooksEndpoint extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_webhooks_endpoint';
    protected const DESCRIPTION = 'Creates a webhook endpoint

Official Rootly endpoint: POST /v1/webhooks/endpoints

Creates a new webhook endpoint from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
