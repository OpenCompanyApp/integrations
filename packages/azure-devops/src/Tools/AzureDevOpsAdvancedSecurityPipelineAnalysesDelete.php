<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Soft-deletes analysis data for all pipelines in a repository, cleaning up the associated Advanced Security alerts..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/pipelineAnalyses.
 */
class AzureDevOpsAdvancedSecurityPipelineAnalysesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_pipeline_analyses_delete';
    protected const DESCRIPTION = 'Soft-deletes analysis data for all pipelines in a repository, cleaning up the associated Advanced Security alerts.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/pipelineAnalyses (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/pipelineAnalyses';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
