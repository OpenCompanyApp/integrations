<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/environments/{orgName}/{envName}/hooks/{hookName}.
 */
class PulumiEnvironmentsDeleteWebhookPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_delete_webhook_preview_environments';
    protected const DESCRIPTION = 'DeleteWebhook

Official Pulumi Cloud endpoint: DELETE /api/preview/environments/{orgName}/{envName}/hooks/{hookName}

Deletes a webhook from a Pulumi ESC environment. The webhook is identified by its name in the URL path. After deletion, the external service will no longer receive notifications for environment events. Returns 204 on success with no response body.';
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
    protected const METHOD = 'delete';
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
