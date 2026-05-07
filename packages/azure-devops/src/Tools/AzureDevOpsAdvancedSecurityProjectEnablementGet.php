<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the current status of Advanced Security for a project.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/{project}/_apis/management/enablement.
 */
class AzureDevOpsAdvancedSecurityProjectEnablementGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_project_enablement_get';
    protected const DESCRIPTION = 'Get the current status of Advanced Security for a project

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/{project}/_apis/management/enablement (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_all_properties' => ['type' => 'boolean', 'required' => false, 'description' => 'When true, also determine if pushes are blocked if they contain secrets'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/management/enablement';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeAllProperties' => 'include_all_properties', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
