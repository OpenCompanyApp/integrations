<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the classification node for a given node path..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}.
 */
class AzureDevOpsWitClassificationNodesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_classification_nodes_get';
    protected const DESCRIPTION = 'Gets the classification node for a given node path.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'structure_group' => ['type' => 'string', 'required' => true, 'description' => 'Structure group of the classification node, area or iteration.'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the classification node.'], 'depth' => ['type' => 'number', 'required' => false, 'description' => 'Depth of children to fetch.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'structureGroup' => 'structure_group', 'path' => 'path'];
    protected const QUERY_PARAMS = ['$depth' => 'depth', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
