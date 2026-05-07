<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateAzureDevOpsSetup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/azure-devops.
 */
class PulumiVCSIntegrationsCreateAzureDevOpsSetup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_create_azure_dev_ops_setup';
    protected const DESCRIPTION = 'CreateAzureDevOpsSetup

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/azure-devops

Creates a new Azure DevOps integration for an organization. Requires an Azure DevOps organization and project to be specified in the request body. Returns 409 if an integration already exists for the specified project.';
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
    protected const PATH = '/api/console/orgs/{orgName}/integrations/azure-devops';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
