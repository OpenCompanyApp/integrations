<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a safe raw GET request against the OneSignal API.
 */
class OneSignalApiGet extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_api_get';
    }

    public function description(): string
    {
        return 'Call a safe relative OneSignal API path with GET for endpoints not yet wrapped by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path such as /notifications. Absolute URLs are rejected.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute raw GET request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->required($args, 'path'),
            is_array($args['params'] ?? null) ? $args['params'] : [],
        ));
    }
}
