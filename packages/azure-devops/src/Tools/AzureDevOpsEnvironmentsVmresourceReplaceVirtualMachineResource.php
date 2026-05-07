<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Replace Virtual Machine Resource.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines.
 */
class AzureDevOpsEnvironmentsVmresourceReplaceVirtualMachineResource extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_vmresource_replace_virtual_machine_resource';
    protected const DESCRIPTION = 'Replace Virtual Machine Resource

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Properties to replace Virtual Machine Resource'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the Environment'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
