<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes/{resourceId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes/{resourceId}.
 */
class AzureDevOpsEnvironmentsKubernetesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_kubernetes_get';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes/{resourceId}

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes/{resourceId} (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `environmentId`.'], 'resource_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `resourceId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes/{resourceId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id', 'resourceId' => 'resource_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
