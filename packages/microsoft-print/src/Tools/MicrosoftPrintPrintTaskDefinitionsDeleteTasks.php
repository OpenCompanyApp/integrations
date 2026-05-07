<?php

namespace OpenCompany\Integrations\MicrosoftPrint\Tools;

/**
 * Delete navigation property tasks for print.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /print/taskDefinitions/{printTaskDefinition-id}/tasks/{printTask-id}.
 */
class MicrosoftPrintPrintTaskDefinitionsDeleteTasks extends AbstractMicrosoftPrintTool
{
    protected const NAME = 'microsoft_print_print_task_definitions_delete_tasks';
    protected const DESCRIPTION = 'Delete navigation property tasks for print\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /print/taskDefinitions/{printTaskDefinition-id}/tasks/{printTask-id}.';
    protected const PARAMETERS = ['print_task_definition_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printTaskDefinition-id`.'], 'print_task_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printTask-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/print/taskDefinitions/{printTaskDefinition-id}/tasks/{printTask-id}';
    protected const PATH_PARAMS = ['printTaskDefinition-id' => 'print_task_definition_id', 'printTask-id' => 'print_task_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
