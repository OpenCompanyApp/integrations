<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the work items associated with a build. Only work items in the same project are returned..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/workitems.
 */
class AzureDevOpsBuildBuildsGetBuildWorkItemsRefs extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_get_build_work_items_refs';
    protected const DESCRIPTION = 'Gets the work items associated with a build. Only work items in the same project are returned.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/workitems (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of work items to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
