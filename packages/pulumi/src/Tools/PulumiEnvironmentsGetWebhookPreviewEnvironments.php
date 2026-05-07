<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/hooks/{hookName}.
 */
class PulumiEnvironmentsGetWebhookPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_webhook_preview_environments';
    protected const DESCRIPTION = 'GetWebhook

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/hooks/{hookName}

Returns the configuration and status of a single webhook for a Pulumi ESC environment. The webhook is identified by its name in the URL path. The response includes the webhook\'s destination URL, event filters, format, and active status. Returns 404 if the webhook does not exist.';
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
);
    protected const METHOD = 'get';
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
