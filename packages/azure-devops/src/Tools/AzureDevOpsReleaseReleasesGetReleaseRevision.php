<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get release for a given revision number..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId}.
 */
class AzureDevOpsReleaseReleasesGetReleaseRevision extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_releases_get_release_revision';
    protected const DESCRIPTION = 'Get release for a given revision number.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/releases/{releaseId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'release_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the release.'], 'definition_snapshot_revision' => ['type' => 'number', 'required' => false, 'description' => 'Definition snapshot revision number.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.9`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/releases/{releaseId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'releaseId' => 'release_id'];
    protected const QUERY_PARAMS = ['definitionSnapshotRevision' => 'definition_snapshot_revision', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.9';
}
