<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a Webhook Endpoint.
 *
 * Maps to the official WorkOS endpoint patch /webhook_endpoints/{id}.
 */
class WorkOSWebhookEndpointsUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_webhook_endpoints_update';
    protected const DESCRIPTION = 'Update a Webhook Endpoint

Official WorkOS endpoint: PATCH /webhook_endpoints/{id}

Update the properties of an existing webhook endpoint.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/webhook_endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
