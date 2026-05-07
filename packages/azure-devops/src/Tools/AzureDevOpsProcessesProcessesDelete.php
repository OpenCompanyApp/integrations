<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes a process of a specific ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/work/processes/{processTypeId}.
 */
class AzureDevOpsProcessesProcessesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_processes_delete';
    protected const DESCRIPTION = 'Removes a process of a specific ID.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/work/processes/{processTypeId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_type_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `processTypeId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processTypeId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processTypeId' => 'process_type_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
