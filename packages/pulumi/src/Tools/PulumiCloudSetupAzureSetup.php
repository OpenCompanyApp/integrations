<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AzureSetup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/cloudsetup/{orgName}/oauth/azure/setup.
 */
class PulumiCloudSetupAzureSetup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_cloud_setup_azure_setup';
    protected const DESCRIPTION = 'AzureSetup

Official Pulumi Cloud endpoint: POST /api/esc/cloudsetup/{orgName}/oauth/azure/setup

Sets up Azure infrastructure and ESC environments using OAuth credentials';
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
    protected const PATH = '/api/esc/cloudsetup/{orgName}/oauth/azure/setup';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
