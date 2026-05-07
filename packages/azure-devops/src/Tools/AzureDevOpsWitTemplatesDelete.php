<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes the template with given id.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/{team}/_apis/wit/templates/{templateId}.
 */
class AzureDevOpsWitTemplatesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_templates_delete';
    protected const DESCRIPTION = 'Deletes the template with given id

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/{team}/_apis/wit/templates/{templateId} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template id'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/wit/templates/{templateId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team', 'templateId' => 'template_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
