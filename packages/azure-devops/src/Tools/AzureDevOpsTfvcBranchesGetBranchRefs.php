<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get branch hierarchies below the specified scopePath.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/branches.
 */
class AzureDevOpsTfvcBranchesGetBranchRefs extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_tfvc_branches_get_branch_refs';
    protected const DESCRIPTION = 'Get branch hierarchies below the specified scopePath

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/tfvc/branches (spec: tfvc/7.2/tfvc.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'scope_path' => ['type' => 'string', 'required' => false, 'description' => 'Full path to the branch. Default: $/ Examples: $/, $/MyProject, $/MyProject/SomeFolder.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Return deleted branches. Default: False'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Return links. Default: False'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/tfvc/branches';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['scopePath' => 'scope_path', 'includeDeleted' => 'include_deleted', 'includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
