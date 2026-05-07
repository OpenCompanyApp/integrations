<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/environments/{orgName}/{envName}/hooks/{hookName}.
 */
class PulumiEnvironmentsUpdateWebhookPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_webhook_preview_environments';
    protected const DESCRIPTION = 'UpdateWebhook

Official Pulumi Cloud endpoint: PATCH /api/preview/environments/{orgName}/{envName}/hooks/{hookName}

Updates the configuration of an existing webhook on a Pulumi ESC environment. The webhook is identified by its name in the URL path. The request body contains the updated webhook configuration including destination URL, event filters, format, and active status. Returns the updated WebhookResponse on success. Returns 400 if an invalid format is specified.';
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
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/hooks/{hookName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
