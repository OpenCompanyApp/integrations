<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListCustomVCSIntegrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/custom.
 */
class PulumiVCSIntegrationsListCustomVCSIntegrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_custom_vcsintegrations';
    protected const DESCRIPTION = 'ListCustomVCSIntegrations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/custom

Lists all custom VCS integrations configured for an organization. Returns each integration\'s configuration, webhook URL, and configured repositories. Webhook secrets are not included in list responses.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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
