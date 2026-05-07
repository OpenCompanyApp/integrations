<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke action resume.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identityGovernance/lifecycleWorkflows/workflowTemplates/{workflowTemplate-id}/tasks/{task-id}/taskProcessingResults/{taskProcessingResult-id}/microsoft.graph.identityGovernance.resume.
 */
class MicrosoftEntraIdIdentityGovernanceLifecycleWorkflowsWorkflowTemplatesWorkflowTemplateTasksTaskTaskProcessingResultsTaskProcessingResultResume extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_lifecycle_workflows_workflow_templates_workflow_template_tasks_task_task_processing_results_task_processing_result_resume';
    protected const DESCRIPTION = 'Invoke action resume\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identityGovernance/lifecycleWorkflows/workflowTemplates/{workflowTemplate-id}/tasks/{task-id}/taskProcessingResults/{taskProcessingResult-id}/microsoft.graph.identityGovernance.resume.';
    protected const PARAMETERS = ['workflow_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workflowTemplate-id`.'], 'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `task-id`.'], 'task_processing_result_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `taskProcessingResult-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identityGovernance/lifecycleWorkflows/workflowTemplates/{workflowTemplate-id}/tasks/{task-id}/taskProcessingResults/{taskProcessingResult-id}/microsoft.graph.identityGovernance.resume';
    protected const PATH_PARAMS = ['workflowTemplate-id' => 'workflow_template_id', 'task-id' => 'task_id', 'taskProcessingResult-id' => 'task_processing_result_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
