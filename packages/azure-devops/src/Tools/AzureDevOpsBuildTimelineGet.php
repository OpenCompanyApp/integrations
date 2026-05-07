<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets details for a build.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/timeline/{timelineId}.
 */
class AzureDevOpsBuildTimelineGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_timeline_get';
    protected const DESCRIPTION = 'Gets details for a build

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/timeline/{timelineId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `buildId`.'], 'timeline_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `timelineId`.'], 'change_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `changeId`.'], 'plan_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `planId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/timeline/{timelineId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'timelineId' => 'timeline_id'];
    protected const QUERY_PARAMS = ['changeId' => 'change_id', 'planId' => 'plan_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
