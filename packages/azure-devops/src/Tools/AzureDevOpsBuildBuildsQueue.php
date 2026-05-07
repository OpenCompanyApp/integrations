<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queues a build.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/build/builds.
 */
class AzureDevOpsBuildBuildsQueue extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_builds_queue';
    protected const DESCRIPTION = 'Queues a build

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/build/builds (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'ignore_warnings' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `ignoreWarnings`.'], 'check_in_ticket' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `checkInTicket`.'], 'source_build_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `sourceBuildId`.'], 'definition_id' => ['type' => 'number', 'required' => false, 'description' => 'Optional definition id to queue a build without a body. Ignored if there\'s a valid body'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.8`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/builds';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['ignoreWarnings' => 'ignore_warnings', 'checkInTicket' => 'check_in_ticket', 'sourceBuildId' => 'source_build_id', 'definitionId' => 'definition_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.8';
}
