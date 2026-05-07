<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a Webhook Endpoint.
 *
 * Maps to the official WorkOS endpoint post /webhook_endpoints.
 */
class WorkOSWebhookEndpointsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_webhook_endpoints_create';
    protected const DESCRIPTION = 'Create a Webhook Endpoint

Official WorkOS endpoint: POST /webhook_endpoints

Create a new webhook endpoint to receive event notifications.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/webhook_endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
