<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a single work item from a template..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/${type}.
 */
class AzureDevOpsWitWorkItemsGetWorkItemTemplate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_items_get_work_item_template';
    protected const DESCRIPTION = 'Returns a single work item from a template.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitems/${type} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'The work item type name'], 'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated list of requested fields'], 'as_of' => ['type' => 'string', 'required' => false, 'description' => 'AsOf UTC date time string'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The expand parameters for work item attributes. Possible options are { None, Relations, Fields, Links, All }.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitems/${type}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'type' => 'type'];
    protected const QUERY_PARAMS = ['fields' => 'fields', 'asOf' => 'as_of', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
