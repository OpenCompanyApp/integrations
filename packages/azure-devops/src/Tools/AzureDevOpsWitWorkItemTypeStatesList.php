<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns the state names and colors for a work item type..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypes/{type}/states.
 */
class AzureDevOpsWitWorkItemTypeStatesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_type_states_list';
    protected const DESCRIPTION = 'Returns the state names and colors for a work item type.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypes/{type}/states (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'The state name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitemtypes/{type}/states';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'type' => 'type'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
