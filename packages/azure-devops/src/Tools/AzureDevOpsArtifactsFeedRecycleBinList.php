<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query for feeds within the recycle bin. If the project parameter is present, gets all feeds in recycle bin in the given project. If omitted, gets all feeds in recycle bin in the organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feedrecyclebin.
 */
class AzureDevOpsArtifactsFeedRecycleBinList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_feed_recycle_bin_list';
    protected const DESCRIPTION = 'Query for feeds within the recycle bin. If the project parameter is present, gets all feeds in recycle bin in the given project. If omitted, gets all feeds in recycle bin in the organization.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feedrecyclebin (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feedrecyclebin';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
