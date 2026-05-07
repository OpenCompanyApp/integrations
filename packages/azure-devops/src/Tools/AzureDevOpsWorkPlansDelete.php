<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete the specified plan.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/work/plans/{id}.
 */
class AzureDevOpsWorkPlansDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_plans_delete';
    protected const DESCRIPTION = 'Delete the specified plan

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/work/plans/{id} (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'id' => ['type' => 'string', 'required' => true, 'description' => 'Identifier of the plan'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/work/plans/{id}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'id' => 'id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
