<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PingOrganizationWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/hooks/{hookName}/ping.
 */
class PulumiOrganizationsPingOrganizationWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_ping_organization_webhook';
    protected const DESCRIPTION = 'PingOrganizationWebhook

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/hooks/{hookName}/ping

Sends a test ping to an organization webhook to validate that it is working. This function bypasses the message queue machinery and issues the request directly to the webhook.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/hooks/{hookName}/ping';
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
