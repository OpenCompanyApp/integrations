<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListWebhooks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/hooks.
 */
class PulumiEnvironmentsListWebhooksEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_webhooks_esc_environments';
    protected const DESCRIPTION = 'ListWebhooks

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/hooks

Returns a list of all webhooks configured for a Pulumi ESC environment. Each webhook entry includes its name, destination URL, event filters, format, and active status. Webhooks enable external services to be notified of environment events such as updates and opens.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/hooks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
