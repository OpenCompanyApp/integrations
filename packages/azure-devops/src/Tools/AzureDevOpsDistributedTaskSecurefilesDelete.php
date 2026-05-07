<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a secure file.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles/{secureFileId}.
 */
class AzureDevOpsDistributedTaskSecurefilesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_securefiles_delete';
    protected const DESCRIPTION = 'Delete a secure file

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles/{secureFileId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'secure_file_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique secure file Id'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/securefiles/{secureFileId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'secureFileId' => 'secure_file_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
