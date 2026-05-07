<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/hooks.
 */
class PulumiEnvironmentsCreateWebhookPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_webhook_preview_environments';
    protected const DESCRIPTION = 'CreateWebhook

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/hooks

Creates a new webhook for a Pulumi ESC environment. Webhooks allow external services to be notified when environment events occur, such as updates or opens. The request body specifies the webhook configuration including the destination URL, event filters, and format. Returns 400 if the organization name in the request body does not match the URL path parameter. Returns 409 if a webhook with the same name already exists.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/hooks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
