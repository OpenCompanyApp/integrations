<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve one Appwrite function.
 */
class AppwriteGetFunction extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_function';
    protected string $toolDescription = 'Get one function by ID.';
    protected string $path = '/functions/{function_id}';
    protected array $required = ['function_id'];
    protected array $parameters = [
        'function_id' => ['type' => 'string', 'required' => true, 'description' => 'Function ID.'],
    ];
}
