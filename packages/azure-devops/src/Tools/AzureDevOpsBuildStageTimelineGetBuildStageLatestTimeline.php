<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the latest timeline for a build filtered to a specific stage..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/Timeline/stages/{stageName}.
 */
class AzureDevOpsBuildStageTimelineGetBuildStageLatestTimeline extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_stage_timeline_get_build_stage_latest_timeline';
    protected const DESCRIPTION = 'Gets the latest timeline for a build filtered to a specific stage.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/Timeline/stages/{stageName} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'stage_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the stage to filter by.'], 'change_id' => ['type' => 'number', 'required' => false, 'description' => 'The change ID to filter by.'], 'plan_id' => ['type' => 'string', 'required' => false, 'description' => 'The ID of the plan.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/Timeline/stages/{stageName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'stageName' => 'stage_name'];
    protected const QUERY_PARAMS = ['changeId' => 'change_id', 'planId' => 'plan_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
