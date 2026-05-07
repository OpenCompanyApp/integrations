<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve one Appwrite function execution.
 */
class AppwriteGetExecution extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_execution';
    protected string $toolDescription = 'Get one function execution by ID.';
    protected string $path = '/functions/{function_id}/executions/{execution_id}';
    protected array $required = ['function_id', 'execution_id'];
    protected array $parameters = [
        'function_id' => ['type' => 'string', 'required' => true, 'description' => 'Function ID.'],
        'execution_id' => ['type' => 'string', 'required' => true, 'description' => 'Execution ID.'],
    ];
}
