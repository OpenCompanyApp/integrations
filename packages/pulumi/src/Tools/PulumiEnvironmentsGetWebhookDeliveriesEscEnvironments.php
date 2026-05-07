<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetWebhookDeliveries.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/hooks/{hookName}/deliveries.
 */
class PulumiEnvironmentsGetWebhookDeliveriesEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_webhook_deliveries_esc_environments';
    protected const DESCRIPTION = 'GetWebhookDeliveries

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/hooks/{hookName}/deliveries

Returns a list of recent delivery attempts for a specific webhook on a Pulumi ESC environment. Each delivery record includes the HTTP status code, response body, timestamp, and whether the delivery was successful. This is useful for debugging webhook integration issues and verifying that events are being received.';
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
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/hooks/{hookName}/deliveries';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
