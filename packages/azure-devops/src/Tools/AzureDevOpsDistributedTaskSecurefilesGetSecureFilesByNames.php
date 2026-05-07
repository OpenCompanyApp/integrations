<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get secure files.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles.
 */
class AzureDevOpsDistributedTaskSecurefilesGetSecureFilesByNames extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_securefiles_get_secure_files_by_names';
    protected const DESCRIPTION = 'Get secure files

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'secure_file_names' => ['type' => 'string', 'required' => false, 'description' => 'A list of secure file Ids'], 'include_download_tickets' => ['type' => 'boolean', 'required' => false, 'description' => 'If includeDownloadTickets is true and the caller has permissions, a download ticket for each secure file is included in the response.'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `actionFilter`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/securefiles';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['secureFileNames' => 'secure_file_names', 'includeDownloadTickets' => 'include_download_tickets', 'actionFilter' => 'action_filter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
