<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the permissions on a feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions.
 */
class AzureDevOpsArtifactsFeedManagementSetFeedPermissions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_feed_management_set_feed_permissions';
    protected const DESCRIPTION = 'Update the permissions on a feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Permissions to set.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
