<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a list of the IDs and the URLs of the deleted the work items in the Recycle Bin..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/recyclebin.
 */
class AzureDevOpsWitRecyclebinGetDeletedWorkItemShallowReferences extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_recyclebin_get_deleted_work_item_shallow_references';
    protected const DESCRIPTION = 'Gets a list of the IDs and the URLs of the deleted the work items in the Recycle Bin.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/recyclebin (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/recyclebin';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
