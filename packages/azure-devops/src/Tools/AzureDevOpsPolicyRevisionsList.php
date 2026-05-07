<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve all revisions for a given policy..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/policy/configurations/{configurationId}/revisions.
 */
class AzureDevOpsPolicyRevisionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_revisions_list';
    protected const DESCRIPTION = 'Retrieve all revisions for a given policy.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/policy/configurations/{configurationId}/revisions (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'configuration_id' => ['type' => 'number', 'required' => true, 'description' => 'The policy configuration ID.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The number of revisions to retrieve.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'The number of revisions to ignore. For example, to retrieve results 101-150, set top to 50 and skip to 100.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/configurations/{configurationId}/revisions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'configurationId' => 'configuration_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
