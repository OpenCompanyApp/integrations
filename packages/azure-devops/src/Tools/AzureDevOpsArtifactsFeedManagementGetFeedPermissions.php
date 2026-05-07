<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the permissions for a feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions.
 */
class AzureDevOpsArtifactsFeedManagementGetFeedPermissions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_feed_management_get_feed_permissions';
    protected const DESCRIPTION = 'Get the permissions for a feed. The project parameter must be supplied if the feed was created in a project. If the feed is not associated with any project, omit the project parameter from the request.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'feed_id' => ['type' => 'string', 'required' => true, 'description' => 'Name or Id of the feed.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_ids' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include user Ids in the response. Default is false.'], 'exclude_inherited_permissions' => ['type' => 'boolean', 'required' => false, 'description' => 'True to only return explicitly set permissions on the feed. Default is false.'], 'identity_descriptor' => ['type' => 'string', 'required' => false, 'description' => 'Filter permissions to the provided identity.'], 'include_deleted_feeds' => ['type' => 'boolean', 'required' => false, 'description' => 'If includeDeletedFeeds is true, then feedId must be specified by name and not by Guid.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/packaging/Feeds/{feedId}/permissions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'feedId' => 'feed_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeIds' => 'include_ids', 'excludeInheritedPermissions' => 'exclude_inherited_permissions', 'identityDescriptor' => 'identity_descriptor', 'includeDeletedFeeds' => 'include_deleted_feeds', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
