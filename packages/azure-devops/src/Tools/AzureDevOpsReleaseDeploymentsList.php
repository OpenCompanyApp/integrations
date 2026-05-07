<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of deployments.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/deployments.
 */
class AzureDevOpsReleaseDeploymentsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_deployments_list';
    protected const DESCRIPTION = 'Get a list of deployments

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/deployments (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'definition_id' => ['type' => 'number', 'required' => false, 'description' => 'List the deployments for a given definition id.'], 'definition_environment_id' => ['type' => 'number', 'required' => false, 'description' => 'List the deployments for a given definition environment id.'], 'created_by' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments for which deployments are created as identity specified.'], 'min_modified_time' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with LastModified time >= minModifiedTime.'], 'max_modified_time' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with LastModified time <= maxModifiedTime.'], 'deployment_status' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with given deployment status. Default is \'All\'.'], 'operation_status' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with given operation status. Default is \'All\'.'], 'latest_attempts_only' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to include deployments with latest attempt only. Default is \'false\'.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with given query order. Default is \'Descending\'.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'List the deployments with given top. Default top is \'50\' and Max top is \'100\'.'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'List the deployments with deployment id >= continuationToken.'], 'created_for' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments for which deployments are requested as identity specified.'], 'min_started_time' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with StartedOn time >= minStartedTime.'], 'max_started_time' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments with StartedOn time <= maxStartedTime.'], 'source_branch' => ['type' => 'string', 'required' => false, 'description' => 'List the deployments that are deployed from given branch name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/deployments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['definitionId' => 'definition_id', 'definitionEnvironmentId' => 'definition_environment_id', 'createdBy' => 'created_by', 'minModifiedTime' => 'min_modified_time', 'maxModifiedTime' => 'max_modified_time', 'deploymentStatus' => 'deployment_status', 'operationStatus' => 'operation_status', 'latestAttemptsOnly' => 'latest_attempts_only', 'queryOrder' => 'query_order', '$top' => 'top', 'continuationToken' => 'continuation_token', 'createdFor' => 'created_for', 'minStartedTime' => 'min_started_time', 'maxStartedTime' => 'max_started_time', 'sourceBranch' => 'source_branch', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
