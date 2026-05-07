<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a process by ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/process/processes/{processId}.
 */
class AzureDevOpsCoreProcessesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_processes_get';
    protected const DESCRIPTION = 'Get a process by ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/process/processes/{processId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'ID for a process.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/process/processes/{processId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
