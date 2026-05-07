<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a safe raw PATCH request against the OneSignal API.
 */
class OneSignalApiPatch extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_api_patch';
    }

    public function description(): string
    {
        return 'Call a safe relative OneSignal API path with PATCH for endpoints not yet wrapped by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON payload.'],
        ];
    }

    /**
     * Execute raw PATCH request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPatch(
            $this->required($args, 'path'),
            is_array($args['payload'] ?? null) ? $args['payload'] : [],
        ));
    }
}
