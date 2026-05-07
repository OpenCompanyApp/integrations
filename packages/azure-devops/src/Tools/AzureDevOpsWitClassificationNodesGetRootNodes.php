<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets root classification nodes under the project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes.
 */
class AzureDevOpsWitClassificationNodesGetRootNodes extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_classification_nodes_get_root_nodes';
    protected const DESCRIPTION = 'Gets root classification nodes under the project.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'depth' => ['type' => 'number', 'required' => false, 'description' => 'Depth of children to fetch.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/classificationnodes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$depth' => 'depth', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
