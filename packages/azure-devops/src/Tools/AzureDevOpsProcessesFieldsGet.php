<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a field in a work item type..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName}.
 */
class AzureDevOpsProcessesFieldsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_fields_get';
    protected const DESCRIPTION = 'Returns a field in a work item type.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'process_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the process.'], 'wit_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the work item type.'], 'field_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'The reference name of the field.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/{processId}/workItemTypes/{witRefName}/fields/{fieldRefName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'processId' => 'process_id', 'witRefName' => 'wit_ref_name', 'fieldRefName' => 'field_ref_name'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
