<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets an individual log file for a build..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/logs/{logId}.
 */
class AzureDevOpsBuildBuildsGetBuildLog extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_get_build_log';
    protected const DESCRIPTION = 'Gets an individual log file for a build.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/logs/{logId} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the build.'], 'log_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the log file.'], 'start_line' => ['type' => 'number', 'required' => false, 'description' => 'The start line.'], 'end_line' => ['type' => 'number', 'required' => false, 'description' => 'The end line.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/logs/{logId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'buildId' => 'build_id', 'logId' => 'log_id'];
    protected const QUERY_PARAMS = ['startLine' => 'start_line', 'endLine' => 'end_line', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
