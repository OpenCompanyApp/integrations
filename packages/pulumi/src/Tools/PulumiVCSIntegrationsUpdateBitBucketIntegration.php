<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateBitBucketIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}.
 */
class PulumiVCSIntegrationsUpdateBitBucketIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_update_bit_bucket_integration';
    protected const DESCRIPTION = 'UpdateBitBucketIntegration

Official Pulumi Cloud endpoint: PATCH /api/console/orgs/{orgName}/integrations/bitbucket/{integrationId}

Updates an existing BitBucket integration\'s settings, such as PR comment preferences and AI summary options.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
