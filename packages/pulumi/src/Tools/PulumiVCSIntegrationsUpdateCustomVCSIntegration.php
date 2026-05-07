<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateCustomVCSIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/console/orgs/{orgName}/integrations/custom/{integrationId}.
 */
class PulumiVCSIntegrationsUpdateCustomVCSIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_update_custom_vcsintegration';
    protected const DESCRIPTION = 'UpdateCustomVCSIntegration

Official Pulumi Cloud endpoint: PATCH /api/console/orgs/{orgName}/integrations/custom/{integrationId}

Updates an existing custom VCS integration\'s settings. All fields are optional; only provided fields are modified. Set regenerateWebhookSecret to true to rotate the webhook HMAC secret, which invalidates the previous secret immediately.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
