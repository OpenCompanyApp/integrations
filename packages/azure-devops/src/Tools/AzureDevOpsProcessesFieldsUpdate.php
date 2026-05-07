<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a field in a work item type..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName}.
 */
class AzureDevOpsProcessesFieldsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_fields_update';
    protected const DESCRIPTION = 'Updates a field in a work item type.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process.'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type.'], 'field_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the field.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'fieldRefName' => 'field_ref_name'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
