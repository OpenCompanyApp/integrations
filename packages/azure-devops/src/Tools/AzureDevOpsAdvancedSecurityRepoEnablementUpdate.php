<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the enablement status of Code Security and Secret Protection, along with their respective features, for a given repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://advsec.dev.azure.com/{organization}/{project}/_apis/management/repositories/{repository}/enablement.
 */
class AzureDevOpsAdvancedSecurityRepoEnablementUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_repo_enablement_update';
    protected const DESCRIPTION = 'Update the enablement status of Code Security and Secret Protection, along with their respective features, for a given repository.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://advsec.dev.azure.com/{organization}/{project}/_apis/management/repositories/{repository}/enablement (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'new status'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the repository'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/management/repositories/{repository}/enablement';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
