<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete an existing classification node..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}.
 */
class AzureDevOpsWitClassificationNodesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_classification_nodes_delete';
    protected const DESCRIPTION = 'Delete an existing classification node.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'structure_group' => ['type' => 'string', 'required' => true, 'description' => 'Structure group of the classification node, area or iteration.'], 'path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the classification node.'], 'reclassify_id' => ['type' => 'number', 'required' => false, 'description' => 'Id of the target classification node for reclassification.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/classificationnodes/{structureGroup}/{path}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'structureGroup' => 'structure_group', 'path' => 'path'];
    protected const QUERY_PARAMS = ['$reclassifyId' => 'reclassify_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}
