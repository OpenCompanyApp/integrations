<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a specific policy type by ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/policy/types/{typeId}.
 */
class AzureDevOpsPolicyTypesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_types_get';
    protected const DESCRIPTION = 'Retrieve a specific policy type by ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/policy/types/{typeId} (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'type_id' => ['type' => 'string', 'required' => true, 'description' => 'The policy ID.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/types/{typeId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'typeId' => 'type_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
