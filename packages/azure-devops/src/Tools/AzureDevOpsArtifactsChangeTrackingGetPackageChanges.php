<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a batch of package changes made to a feed. The changes returned are 'most recent change' so if an Add is followed by an Update before you begin enumerating, you'll only see one change in the batch. While consuming batches using the continuation token, you may see changes to the same package version multiple times if they are happening as you enumerate. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packagechanges.
 */
class AzureDevOpsArtifactsChangeTrackingGetPackageChanges extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_change_tracking_get_package_changes';
    protected const DESCRIPTION = 'Get a batch of package changes made to a feed. The changes returned are \'most recent change\' so if an Add is followed by an Update before you begin enumerating, you\'ll only see one change in the batch. While consuming batches using the continuation token, you may see changes to the same package version multiple times if they are happening as you enumerate. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packagechanges (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'A continuation token which acts as a bookmark to a previously retrieved change. This token allows the user to continue retrieving changes in batches, picking up where the previous batch left off. If specified, all the changes that occur strictly after the token will be returned. If not specified or 0, iteration will start with the first change.'], 'batch_size' => ['type' => 'number', 'required' => false, 'description' => 'Number of package changes to fetch. The default value is 1000. The maximum value is 2000.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/packagechanges';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', 'batchSize' => 'batch_size', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
