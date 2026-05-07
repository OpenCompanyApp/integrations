<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a given state definition in the work item type of the process..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/states/{stateId}.
 */
class AzureDevOpsProcessesStatesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_states_update';
    protected const DESCRIPTION = 'Updates a given state definition in the work item type of the process.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/states/{stateId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the process'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type'], 'state_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the state'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/states/{stateId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'stateId' => 'state_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
