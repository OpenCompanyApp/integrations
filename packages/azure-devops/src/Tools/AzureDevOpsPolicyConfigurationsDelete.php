<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a policy configuration by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/policy/configurations/{configurationId}.
 */
class AzureDevOpsPolicyConfigurationsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_configurations_delete';
    protected const DESCRIPTION = 'Delete a policy configuration by its ID.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/policy/configurations/{configurationId} (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'configuration_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the policy configuration to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/configurations/{configurationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'configurationId' => 'configuration_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
