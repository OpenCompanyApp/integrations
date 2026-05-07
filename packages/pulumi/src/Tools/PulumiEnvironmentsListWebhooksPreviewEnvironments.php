<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListWebhooks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/hooks.
 */
class PulumiEnvironmentsListWebhooksPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_webhooks_preview_environments';
    protected const DESCRIPTION = 'ListWebhooks

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/hooks

Returns a list of all webhooks configured for a Pulumi ESC environment. Each webhook entry includes its name, destination URL, event filters, format, and active status. Webhooks enable external services to be notified of environment events such as updates and opens.';
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
);
    protected const METHOD = 'get';
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
