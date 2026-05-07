<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get subject from identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/lifecycleWorkflows/workflows/{workflow-id}/runs/{run-id}/userProcessingResults/{userProcessingResult-id}/taskProcessingResults/{taskProcessingResult-id}/subject.
 */
class MicrosoftEntraIdIdentityGovernanceLifecycleWorkflowsWorkflowsRunsUserProcessingResultsTaskProcessingResultsGetSubject extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_lifecycle_workflows_workflows_runs_user_processing_results_task_processing_results_get_subject';
    protected const DESCRIPTION = 'Get subject from identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/lifecycleWorkflows/workflows/{workflow-id}/runs/{run-id}/userProcessingResults/{userProcessingResult-id}/taskProcessingResults/{taskProcessingResult-id}/subject.';
    protected const PARAMETERS = ['workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workflow-id`.'], 'run_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `run-id`.'], 'user_processing_result_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userProcessingResult-id`.'], 'task_processing_result_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `taskProcessingResult-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/lifecycleWorkflows/workflows/{workflow-id}/runs/{run-id}/userProcessingResults/{userProcessingResult-id}/taskProcessingResults/{taskProcessingResult-id}/subject';
    protected const PATH_PARAMS = ['workflow-id' => 'workflow_id', 'run-id' => 'run_id', 'userProcessingResult-id' => 'user_processing_result_id', 'taskProcessingResult-id' => 'task_processing_result_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
