<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Create an Appwrite function execution.
 */
class AppwriteCreateExecution extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_create_execution';
    protected string $toolDescription = 'Execute an Appwrite function with optional body, path, method, and headers.';
    protected string $method = 'POST';
    protected string $path = '/functions/{function_id}/executions';
    protected array $required = ['function_id'];
    protected array $bodyParams = ['body', 'async', 'path', 'method', 'headers', 'scheduled_at' => 'scheduledAt'];
    protected array $parameters = [
        'function_id' => ['type' => 'string', 'required' => true, 'description' => 'Function ID.'],
        'body' => ['type' => 'string', 'description' => 'Execution body string.'],
        'async' => ['type' => 'boolean', 'description' => 'Run asynchronously.'],
        'path' => ['type' => 'string', 'description' => 'Execution path.'],
        'method' => ['type' => 'string', 'description' => 'HTTP method passed to the function.'],
        'headers' => ['type' => 'object', 'description' => 'Headers passed to the execution.'],
        'scheduled_at' => ['type' => 'string', 'description' => 'Optional scheduled execution time.'],
    ];
}
