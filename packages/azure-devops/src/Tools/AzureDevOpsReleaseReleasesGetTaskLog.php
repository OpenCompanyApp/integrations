<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the task log of a release as a plain text file..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/deployPhases/{releaseDeployPhaseId}/tasks/{taskId}/logs.
 */
class AzureDevOpsReleaseReleasesGetTaskLog extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_releases_get_task_log';
    protected const DESCRIPTION = 'Gets the task log of a release as a plain text file.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/deployPhases/{releaseDeployPhaseId}/tasks/{taskId}/logs (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release.'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of release environment.'], 'release_deploy_phase_id' => ['type' => 'number', 'required' => true, 'description' => 'Release deploy phase Id.'], 'task_id' => ['type' => 'number', 'required' => true, 'description' => 'ReleaseTask Id for the log.'], 'start_line' => ['type' => 'number', 'required' => false, 'description' => 'Starting line number for logs'], 'end_line' => ['type' => 'number', 'required' => false, 'description' => 'Ending line number for logs'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/releases/{releaseId}/environments/{environmentId}/deployPhases/{releaseDeployPhaseId}/tasks/{taskId}/logs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id', 'environmentId' => 'environment_id', 'releaseDeployPhaseId' => 'release_deploy_phase_id', 'taskId' => 'task_id'];
    protected const QUERY_PARAMS = ['startLine' => 'start_line', 'endLine' => 'end_line', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
