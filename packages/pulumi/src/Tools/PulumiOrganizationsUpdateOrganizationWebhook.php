<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOrganizationWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/hooks/{hookName}.
 */
class PulumiOrganizationsUpdateOrganizationWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_organization_webhook';
    protected const DESCRIPTION = 'UpdateOrganizationWebhook

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/hooks/{hookName}

Updates an existing organization-level webhook\'s configuration, including its destination URL, format, active status, event filter subscriptions, and shared secret. The \'pulumi_deployments\' format can only be used on stack or environment webhooks, not organization-level ones.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
