<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateCustomVCSIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/custom.
 */
class PulumiVCSIntegrationsCreateCustomVCSIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_create_custom_vcsintegration';
    protected const DESCRIPTION = 'CreateCustomVCSIntegration

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/custom

Creates a new custom VCS integration for an organization. Custom VCS integrations allow connecting self-hosted or third-party version control systems (e.g. Gitea, Forgejo, Bitbucket Server) to Pulumi Deployments. Credentials are managed via ESC environments, and deployments are triggered by inbound webhooks. Returns the created integration including its webhook URL and HMAC secret for signature verification.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/custom';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
