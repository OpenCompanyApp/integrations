<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retry or abandon a failed import request. There can only be one active import request associated with a repository. Marking a failed import request abandoned makes it inactive..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests/{importRequestId}.
 */
class AzureDevOpsGitImportRequestsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_import_requests_update';
    protected const DESCRIPTION = 'Retry or abandon a failed import request. There can only be one active import request associated with a repository. Marking a failed import request abandoned makes it inactive.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests/{importRequestId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The updated version of the import request. Currently, the only change allowed is setting the Status to Queued or Abandoned.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'import_request_id' => ['type' => 'number', 'required' => true, 'description' => 'The unique identifier for the import request to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests/{importRequestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id', 'importRequestId' => 'import_request_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
