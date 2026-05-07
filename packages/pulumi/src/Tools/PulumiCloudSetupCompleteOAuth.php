<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CompleteOAuth.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/cloudsetup/{orgName}/oauth/complete.
 */
class PulumiCloudSetupCompleteOAuth extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_complete_oauth';
    protected const DESCRIPTION = 'CompleteOAuth

Official Pulumi Cloud endpoint: POST /api/esc/cloudsetup/{orgName}/oauth/complete

Completes OAuth flow by exchanging authorization code for access token';
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
    protected const PATH = '/api/esc/cloudsetup/{orgName}/oauth/complete';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
