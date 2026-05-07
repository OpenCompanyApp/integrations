<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets information on a specific field..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/fields/{fieldNameOrRefName}.
 */
class AzureDevOpsWitFieldsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_fields_get';
    protected const DESCRIPTION = 'Gets information on a specific field.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/fields/{fieldNameOrRefName} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'field_name_or_ref_name' => ['type' => 'string', 'required' => true, 'description' => 'Field simple name or reference name'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/fields/{fieldNameOrRefName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'fieldNameOrRefName' => 'field_name_or_ref_name', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}
