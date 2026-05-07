<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the work items associated with a build, filtered to specific commits..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/workitems.
 */
class AzureDevOpsBuildBuildsGetBuildWorkItemsRefsFromCommits extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_get_build_work_items_refs_from_commits';
    protected const DESCRIPTION = 'Gets the work items associated with a build, filtered to specific commits.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/workitems (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A comma-delimited list of commit IDs.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of work items to return, or the number of commits to consider if no commit IDs are specified.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
