<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get check configurations for multiple resources by resource type and id..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/queryconfigurations.
 */
class AzureDevOpsApprovalsAndChecksCheckConfigurationsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_check_configurations_query';
    protected const DESCRIPTION = 'Get check configurations for multiple resources by resource type and id.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/queryconfigurations (spec: approvalsAndChecks/7.2/pipelinesChecks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'List of resources.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The properties that should be expanded in the list of check configurations.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/checks/queryconfigurations';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
