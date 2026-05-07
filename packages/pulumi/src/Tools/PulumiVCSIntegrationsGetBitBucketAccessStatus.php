<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetBitBucketAccessStatus.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/bitbucket/access-status.
 */
class PulumiVCSIntegrationsGetBitBucketAccessStatus extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_bit_bucket_access_status';
    protected const DESCRIPTION = 'GetBitBucketAccessStatus

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/bitbucket/access-status

Returns information about a user\'s BitBucket access status for an organization, including whether they have a valid OAuth token and available BitBucket workspaces for new integrations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/bitbucket/access-status';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
