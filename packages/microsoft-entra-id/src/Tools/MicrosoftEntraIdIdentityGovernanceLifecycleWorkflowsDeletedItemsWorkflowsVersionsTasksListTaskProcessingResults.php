<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get taskProcessingResults from identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/lifecycleWorkflows/deletedItems/workflows/{workflow-id}/versions/{workflowVersion-versionNumber}/tasks/{task-id}/taskProcessingResults.
 */
class MicrosoftEntraIdIdentityGovernanceLifecycleWorkflowsDeletedItemsWorkflowsVersionsTasksListTaskProcessingResults extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_lifecycle_workflows_deleted_items_workflows_versions_tasks_list_task_processing_results';
    protected const DESCRIPTION = 'Get taskProcessingResults from identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/lifecycleWorkflows/deletedItems/workflows/{workflow-id}/versions/{workflowVersion-versionNumber}/tasks/{task-id}/taskProcessingResults.';
    protected const PARAMETERS = ['workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workflow-id`.'], 'workflow_version_version_number' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workflowVersion-versionNumber`.'], 'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `task-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/lifecycleWorkflows/deletedItems/workflows/{workflow-id}/versions/{workflowVersion-versionNumber}/tasks/{task-id}/taskProcessingResults';
    protected const PATH_PARAMS = ['workflow-id' => 'workflow_id', 'workflowVersion-versionNumber' => 'workflow_version_version_number', 'task-id' => 'task_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
