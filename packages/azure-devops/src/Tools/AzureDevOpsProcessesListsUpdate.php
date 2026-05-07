<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates a list..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/_apis/work/processes/lists/{listId}.
 */
class AzureDevOpsProcessesListsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_processes_lists_update';
    protected const DESCRIPTION = 'Updates a list.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/_apis/work/processes/lists/{listId} (spec: processes/7.2/workItemTrackingProcess.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the list'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/work/processes/lists/{listId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'listId' => 'list_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
