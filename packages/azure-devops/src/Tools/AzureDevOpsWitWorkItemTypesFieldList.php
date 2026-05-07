<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of fields for a work item type with detailed references..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypes/{type}/fields.
 */
class AzureDevOpsWitWorkItemTypesFieldList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_types_field_list';
    protected const DESCRIPTION = 'Get a list of fields for a work item type with detailed references.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workitemtypes/{type}/fields (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'type' => ['type' => 'string', 'required' => true, 'description' => 'Work item type.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Expand level for the API response. Properties: to include allowedvalues, default value, isRequired etc. as a part of response; None: to skip these properties.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workitemtypes/{type}/fields';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'type' => 'type'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
