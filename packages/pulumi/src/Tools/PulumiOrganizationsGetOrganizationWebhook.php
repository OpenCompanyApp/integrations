<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrganizationWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/hooks/{hookName}.
 */
class PulumiOrganizationsGetOrganizationWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_organization_webhook';
    protected const DESCRIPTION = 'GetOrganizationWebhook

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/hooks/{hookName}

Returns the configuration of a specific organization-level webhook, including its name, destination URL, format (generic JSON, Slack, or Microsoft Teams), active status, event filter subscriptions, and whether a shared secret is configured for HMAC signature verification.';
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
    protected const PATH = '/api/orgs/{orgName}/hooks/{hookName}';
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
