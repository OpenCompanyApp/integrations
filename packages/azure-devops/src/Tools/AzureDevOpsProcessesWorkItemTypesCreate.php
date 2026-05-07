<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a work item type in the process..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypes.
 */
class AzureDevOpsProcessesWorkItemTypesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_work_item_types_create';
    protected const DESCRIPTION = 'Creates a work item type in the process.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypes (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process on which to create work item type.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workitemtypes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
