<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetBitBucketIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}.
 */
class PulumiVCSIntegrationsGetBitBucketIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_bit_bucket_integration';
    protected const DESCRIPTION = 'GetBitBucketIntegration

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}

Gets a specific BitBucket integration by its integration ID. Returns the integration details including the linked BitBucket workspace, authentication configuration, and validity status.';
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
    protected const METHOD = 'get';
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
