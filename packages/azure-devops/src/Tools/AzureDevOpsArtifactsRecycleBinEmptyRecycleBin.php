<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queues a job to remove all package versions from a feed's recycle bin.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages.
 */
class AzureDevOpsArtifactsRecycleBinEmptyRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_recycle_bin_empty_recycle_bin';
    protected const DESCRIPTION = 'Queues a job to remove all package versions from a feed\'s recycle bin

Official Azure DevOps REST API 7.2 endpoint: DELETE https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/RecycleBin/Packages';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
