<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteCustomVCSIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/console/orgs/{orgName}/integrations/custom/{integrationId}.
 */
class PulumiVCSIntegrationsDeleteCustomVCSIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_delete_custom_vcsintegration';
    protected const DESCRIPTION = 'DeleteCustomVCSIntegration

Official Pulumi Cloud endpoint: DELETE /api/console/orgs/{orgName}/integrations/custom/{integrationId}

Removes a specific custom VCS integration from the organization. This permanently deletes the integration, its webhook endpoint, and all configured repository associations.';
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
    protected const METHOD = 'delete';
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
