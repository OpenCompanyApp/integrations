<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a feed, a container for various package types. Feeds can be created in a project if the project parameter is included in the request url. If the project parameter is omitted, the feed will not be associated with a project and will be created at the organization level..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feeds.
 */
class AzureDevOpsArtifactsFeedManagementCreateFeed extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_feed_management_create_feed';
    protected const DESCRIPTION = 'Create a feed, a container for various package types. Feeds can be created in a project if the project parameter is included in the request url. If the project parameter is omitted, the feed will not be associated with a project and will be created at the organization level.

Official Azure DevOps REST API 7.2 endpoint: POST https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feeds (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A JSON object containing both required and optional attributes for the feed. Name is the only required value.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feeds';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
