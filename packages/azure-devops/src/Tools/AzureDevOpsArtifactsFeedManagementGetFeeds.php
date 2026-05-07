<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all feeds in an account where you have the provided role access. If the project parameter is present, gets all feeds in the given project. If omitted, gets all feeds in the organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feeds.
 */
class AzureDevOpsArtifactsFeedManagementGetFeeds extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_feed_management_get_feeds';
    protected const DESCRIPTION = 'Get all feeds in an account where you have the provided role access. If the project parameter is present, gets all feeds in the given project. If omitted, gets all feeds in the organization.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feeds (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'feed_role' => ['type' => 'string', 'required' => false, 'description' => 'Filter by this role, either Administrator(4), Contributor(3), or Reader(2) level permissions.'], 'include_deleted_upstreams' => ['type' => 'boolean', 'required' => false, 'description' => 'Include upstreams that have been deleted in the response.'], 'include_urls' => ['type' => 'boolean', 'required' => false, 'description' => 'Resolve names if true'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['feedRole' => 'feed_role', 'includeDeletedUpstreams' => 'include_deleted_upstreams', 'includeUrls' => 'include_urls', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
