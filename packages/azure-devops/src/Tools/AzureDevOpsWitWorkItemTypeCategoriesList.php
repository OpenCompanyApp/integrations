<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all work item type categories..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypecategories.
 */
class AzureDevOpsWitWorkItemTypeCategoriesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_type_categories_list';
    protected const DESCRIPTION = 'Get all work item type categories.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypecategories (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitemtypecategories';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
