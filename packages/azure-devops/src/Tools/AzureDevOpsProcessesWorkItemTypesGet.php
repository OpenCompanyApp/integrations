<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a single work item type in a process..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypes/{witRefName}.
 */
class AzureDevOpsProcessesWorkItemTypesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_work_item_types_get';
    protected const DESCRIPTION = 'Returns a single work item type in a process.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workitemtypes/{witRefName} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Flag to determine what properties of work item type to return'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workitemtypes/{witRefName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
