<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateBitBucketSetup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/bitbucket.
 */
class PulumiVCSIntegrationsCreateBitBucketSetup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_create_bit_bucket_setup';
    protected const DESCRIPTION = 'CreateBitBucketSetup

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/bitbucket

Creates a new BitBucket integration for an organization. Requires a BitBucket workspace UUID and optionally configures authentication via the user\'s BitBucket OAuth token or a workspace access token / PAT. Returns 409 if an integration already exists for the specified workspace.';
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
    protected const PATH = '/api/console/orgs/{orgName}/integrations/bitbucket';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
