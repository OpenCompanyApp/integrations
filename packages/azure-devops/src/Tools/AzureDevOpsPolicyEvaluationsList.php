<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves a list of all the policy evaluation statuses for a specific pull request. Evaluations are retrieved using an artifact ID which uniquely identifies the pull request. To generate an artifact ID for a pull request, use this template: ``` vstfs:///CodeReview/CodeReviewId/{projectId}/{pullRequestId} ```.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations.
 */
class AzureDevOpsPolicyEvaluationsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_evaluations_list';
    protected const DESCRIPTION = 'Retrieves a list of all the policy evaluation statuses for a specific pull request. Evaluations are retrieved using an artifact ID which uniquely identifies the pull request. To generate an artifact ID for a pull request, use this template: ``` vstfs:///CodeReview/CodeReviewId/{projectId}/{pullRequestId} ```

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'artifact_id' => ['type' => 'string', 'required' => false, 'description' => 'A string which uniquely identifies the target of a policy evaluation.'], 'include_not_applicable' => ['type' => 'boolean', 'required' => false, 'description' => 'Some policies might determine that they do not apply to a specific pull request. Setting this parameter to true will return evaluation records even for policies which don\'t apply to this pull request.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The number of policy evaluation records to retrieve.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'The number of policy evaluation records to ignore. For example, to retrieve results 101-150, set top to 50 and skip to 100.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/evaluations';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['artifactId' => 'artifact_id', 'includeNotApplicable' => 'include_not_applicable', '$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
