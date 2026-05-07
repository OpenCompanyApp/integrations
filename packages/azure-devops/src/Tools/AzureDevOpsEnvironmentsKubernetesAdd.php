<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * POST /{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes.
 */
class AzureDevOpsEnvironmentsKubernetesAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_kubernetes_add';
    protected const DESCRIPTION = 'POST /{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `environmentId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/kubernetes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
