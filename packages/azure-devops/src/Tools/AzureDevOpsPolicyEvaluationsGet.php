<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the present evaluation state of a policy. Each policy which applies to a pull request will have an evaluation state which is specific to that policy running in the context of that pull request. Each evaluation is uniquely identified via a Guid. You can find all the policy evaluations for a specific pull request using the List operation of this controller..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations/{evaluationId}.
 */
class AzureDevOpsPolicyEvaluationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_evaluations_get';
    protected const DESCRIPTION = 'Gets the present evaluation state of a policy. Each policy which applies to a pull request will have an evaluation state which is specific to that policy running in the context of that pull request. Each evaluation is uniquely identified via a Guid. You can find all the policy evaluations for a specific pull request using the List operation of this controller.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations/{evaluationId} (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'evaluation_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the policy evaluation to be retrieved.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/evaluations/{evaluationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'evaluationId' => 'evaluation_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
