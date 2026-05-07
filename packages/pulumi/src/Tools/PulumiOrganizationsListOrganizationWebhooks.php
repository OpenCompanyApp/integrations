<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrganizationWebhooks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/hooks.
 */
class PulumiOrganizationsListOrganizationWebhooks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_organization_webhooks';
    protected const DESCRIPTION = 'ListOrganizationWebhooks

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/hooks

Returns all webhooks configured at the organization level. Each webhook in the response includes its name, destination URL, format (generic JSON, Slack, or Microsoft Teams), active status, and subscribed event filters. Organization-level webhooks can fire on stack lifecycle events, deployment events, drift detection events, and policy violation events.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/hooks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
