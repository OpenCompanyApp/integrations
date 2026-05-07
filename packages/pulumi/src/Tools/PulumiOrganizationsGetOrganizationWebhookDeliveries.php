<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrganizationWebhookDeliveries.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/hooks/{hookName}/deliveries.
 */
class PulumiOrganizationsGetOrganizationWebhookDeliveries extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_organization_webhook_deliveries';
    protected const DESCRIPTION = 'GetOrganizationWebhookDeliveries

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/hooks/{hookName}/deliveries

Returns the recent delivery history for a specific webhook, including the HTTP status code, response time, request payload, and delivery timestamp for each attempt. This allows monitoring webhook health and diagnosing delivery failures. Each delivery includes a unique Pulumi-Webhook-ID.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/hooks/{hookName}/deliveries';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
