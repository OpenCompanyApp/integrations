<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Requeue the policy evaluation. Some policies define a "requeue" action which performs some policy-specific operation. You can trigger this operation by updating an existing policy evaluation and setting the PolicyEvaluationRecord.Status field to Queued. Although any policy evaluation can be requeued, at present only build policies perform any action in response. Requeueing a build policy will queue a new build to run (cancelling any existing build which is running)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations/{evaluationId}.
 */
class AzureDevOpsPolicyEvaluationsRequeuePolicyEvaluation extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_policy_evaluations_requeue_policy_evaluation';
    protected const DESCRIPTION = 'Requeue the policy evaluation. Some policies define a "requeue" action which performs some policy-specific operation. You can trigger this operation by updating an existing policy evaluation and setting the PolicyEvaluationRecord.Status field to Queued. Although any policy evaluation can be requeued, at present only build policies perform any action in response. Requeueing a build policy will queue a new build to run (cancelling any existing build which is running).

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/policy/evaluations/{evaluationId} (spec: policy/7.2/policy.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'evaluation_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the policy evaluation to be retrieved.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/policy/evaluations/{evaluationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'evaluationId' => 'evaluation_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}
