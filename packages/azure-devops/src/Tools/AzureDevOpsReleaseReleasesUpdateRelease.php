<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a complete release object..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}.
 */
class AzureDevOpsReleaseReleasesUpdateRelease extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_releases_update_release';
    protected const DESCRIPTION = 'Update a complete release object.

Official Azure DevOps REST API 7.2 endpoint: PUT https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Release object for update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.9`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/releases/{releaseId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.9';
}
