<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetCustomVCSIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/custom/{integrationId}.
 */
class PulumiVCSIntegrationsGetCustomVCSIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_custom_vcsintegration';
    protected const DESCRIPTION = 'GetCustomVCSIntegration

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/custom/{integrationId}

Gets a specific custom VCS integration by its integration ID. Returns the integration details including its configuration, webhook URL, and configured repositories. The webhook secret is not included; it is only returned at creation time or when regenerated via update.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The custom VCS integration identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/custom/{integrationId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'integrationId' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
