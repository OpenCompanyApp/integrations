<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AWSSSOInitiate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/cloudsetup/{orgName}/aws/sso/initiate.
 */
class PulumiCloudSetupAWSSSOInitiate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_awsssoinitiate';
    protected const DESCRIPTION = 'AWSSSOInitiate

Official Pulumi Cloud endpoint: POST /api/esc/cloudsetup/{orgName}/aws/sso/initiate

Initiates the AWS SSO flow';
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
    protected const PATH = '/api/esc/cloudsetup/{orgName}/aws/sso/initiate';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
