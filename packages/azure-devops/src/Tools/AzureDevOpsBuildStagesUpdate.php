<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a build stage.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/stages/{stageRefName}.
 */
class AzureDevOpsBuildStagesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_stages_update';
    protected const DESCRIPTION = 'Update a build stage

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/build/builds/{buildId}/stages/{stageRefName} (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'build_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `buildId`.'], 'stage_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `stageRefName`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds/{buildId}/stages/{stageRefName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'buildId' => 'build_id', 'stageRefName' => 'stage_ref_name', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
