<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOrganizationWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/hooks/{hookName}.
 */
class PulumiOrganizationsDeleteOrganizationWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_organization_webhook';
    protected const DESCRIPTION = 'DeleteOrganizationWebhook

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/hooks/{hookName}

Permanently deletes an organization-level webhook. The webhook will no longer receive event notifications for stack updates, deployments, drift detection, or policy violations. This action cannot be undone.';
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
    protected const METHOD = 'delete';
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
