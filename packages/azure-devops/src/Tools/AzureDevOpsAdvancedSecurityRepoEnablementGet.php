<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Determines if Code Security, Secret Protection, and their features are enabled for the repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/{project}/_apis/management/repositories/{repository}/enablement.
 */
class AzureDevOpsAdvancedSecurityRepoEnablementGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_repo_enablement_get';
    protected const DESCRIPTION = 'Determines if Code Security, Secret Protection, and their features are enabled for the repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/{project}/_apis/management/repositories/{repository}/enablement (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository'], 'include_all_properties' => ['type' => 'boolean', 'required' => false, 'description' => 'When true, will also determine if pushes are blocked when secrets are detected'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/management/repositories/{repository}/enablement';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['includeAllProperties' => 'include_all_properties', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
