<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a Webhook Endpoint.
 *
 * Maps to the official WorkOS endpoint delete /webhook_endpoints/{id}.
 */
class WorkOSWebhookEndpointsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_webhook_endpoints_delete';
    protected const DESCRIPTION = 'Delete a Webhook Endpoint

Official WorkOS endpoint: DELETE /webhook_endpoints/{id}

Delete an existing webhook endpoint.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/webhook_endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
