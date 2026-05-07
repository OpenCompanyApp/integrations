<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a release environment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/releases/{releaseId}/environments/{environmentId}.
 */
class AzureDevOpsReleaseReleasesGetReleaseEnvironment extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_releases_get_release_environment';
    protected const DESCRIPTION = 'Get a release environment.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/Release/releases/{releaseId}/environments/{environmentId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release.'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release environment.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'A property that should be expanded in the environment.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.8`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/Release/releases/{releaseId}/environments/{environmentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.8';
}
