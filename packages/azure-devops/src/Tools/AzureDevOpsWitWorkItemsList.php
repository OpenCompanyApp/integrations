<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a list of work items (Maximum 200).
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitems.
 */
class AzureDevOpsWitWorkItemsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_items_list';
    protected const DESCRIPTION = 'Returns a list of work items (Maximum 200)

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitems (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'The comma-separated list of requested work item ids. (Maximum 200 ids allowed).'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated list of requested fields'], 'as_of' => ['type' => 'string', 'required' => false, 'description' => 'AsOf UTC date time string'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'The expand parameters for work item attributes. Possible options are { None, Relations, Fields, Links, All }.'], 'error_policy' => ['type' => 'string', 'required' => false, 'description' => 'The flag to control error policy in a bulk get work items request. Possible options are {Fail, Omit}.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['ids' => 'ids', 'fields' => 'fields', 'asOf' => 'as_of', '$expand' => 'expand', 'errorPolicy' => 'error_policy', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
