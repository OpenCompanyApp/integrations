<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update check configuration.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/configurations/{id}.
 */
class AzureDevOpsApprovalsAndChecksCheckConfigurationsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_check_configurations_update';
    protected const DESCRIPTION = 'Update check configuration

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/configurations/{id} (spec: approvalsAndChecks/7.2/pipelinesChecks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'check configuration'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'check configuration id'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/checks/configurations/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
