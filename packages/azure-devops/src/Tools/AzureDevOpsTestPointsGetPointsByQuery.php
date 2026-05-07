<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get test points using query..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/test/points.
 */
class AzureDevOpsTestPointsGetPointsByQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_points_get_points_by_query';
    protected const DESCRIPTION = 'Get test points using query.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/test/points (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'TestPointsQuery to get test points.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of test points to skip..'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of test points to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/points';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$skip' => 'skip', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
