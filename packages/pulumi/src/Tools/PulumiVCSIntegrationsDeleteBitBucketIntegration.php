<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteBitBucketIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}.
 */
class PulumiVCSIntegrationsDeleteBitBucketIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_delete_bit_bucket_integration';
    protected const DESCRIPTION = 'DeleteBitBucketIntegration

Official Pulumi Cloud endpoint: DELETE /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}

Removes a specific BitBucket integration from the organization. Cleans up associated webhooks and access tokens.';
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
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The BitBucket integration identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}';
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
