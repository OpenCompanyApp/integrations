<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update an existing classification node..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}.
 */
class AzureDevOpsWitClassificationNodesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_classification_nodes_update';
    protected const DESCRIPTION = 'Update an existing classification node.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Node to create or update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'structure_group' => ['type' => 'string', 'required' => true, 'description' => 'Structure group of the classification node, area or iteration.'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the classification node.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'structureGroup' => 'structure_group', 'path' => 'path'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
