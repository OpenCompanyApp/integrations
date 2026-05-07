<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * This endpoint is deprecated. Please see the Build Status REST endpoint..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/public/build/definitions/{project}/{definitionId}/badge.
 */
class AzureDevOpsBuildBadgeGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_badge_get';
    protected const DESCRIPTION = 'This endpoint is deprecated. Please see the Build Status REST endpoint.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/public/build/definitions/{project}/{definitionId}/badge (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'The project ID or name.'], 'definition_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the definition.'], 'branch_name' => ['type' => 'string', 'required' => false, 'description' => 'The name of the branch.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/public/build/definitions/{project}/{definitionId}/badge';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'definitionId' => 'definition_id'];
    protected const QUERY_PARAMS = ['branchName' => 'branch_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
