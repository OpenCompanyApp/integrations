<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query to determine which feeds have changed since the last call, tracked through the provided continuationToken. Only changes to a feed itself are returned and impact the continuationToken, not additions or alterations to packages within the feeds. If the project parameter is present, gets all feed changes in the given project. If omitted, gets all feed changes in the organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feedchanges.
 */
class AzureDevOpsArtifactsChangeTrackingGetFeedChanges extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_change_tracking_get_feed_changes';
    protected const DESCRIPTION = 'Query to determine which feeds have changed since the last call, tracked through the provided continuationToken. Only changes to a feed itself are returned and impact the continuationToken, not additions or alterations to packages within the feeds. If the project parameter is present, gets all feed changes in the given project. If omitted, gets all feed changes in the organization.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/feedchanges (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, get changes for all feeds including deleted feeds. The default value is false.'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'A continuation token which acts as a bookmark to a previously retrieved change. This token allows the user to continue retrieving changes in batches, picking up where the previous batch left off. If specified, all the changes that occur strictly after the token will be returned. If not specified or 0, iteration will start with the first change.'], 'batch_size' => ['type' => 'number', 'required' => false, 'description' => 'Number of package changes to fetch. The default value is 1000. The maximum value is 2000.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/feedchanges';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeDeleted' => 'include_deleted', 'continuationToken' => 'continuation_token', 'batchSize' => 'batch_size', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
