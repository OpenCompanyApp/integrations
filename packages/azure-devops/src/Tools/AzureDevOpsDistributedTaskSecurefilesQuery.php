<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query secure files using a name pattern and a condition on file properties..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles.
 */
class AzureDevOpsDistributedTaskSecurefilesQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_securefiles_query';
    protected const DESCRIPTION = 'Query secure files using a name pattern and a condition on file properties.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/distributedtask/securefiles (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The main condition syntax is described [here](https://go.microsoft.com/fwlink/?linkid=842996). Use the *property(\'property-name\')* function to access the value of the specified property of a secure file. It returns null if the property is not set. E.g. ``` and( eq( property(\'devices\'), \'2\' ), in( property(\'provisioning profile type\'), \'ad hoc\', \'development\' ) ) ```'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'name_pattern' => ['type' => 'string', 'required' => false, 'description' => 'Name of the secure file to match. Can include wildcards to match multiple files.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/securefiles';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['namePattern' => 'name_pattern', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
