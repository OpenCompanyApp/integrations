<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a safe raw POST request against the OneSignal API.
 */
class OneSignalApiPost extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_api_post';
    }

    public function description(): string
    {
        return 'Call a safe relative OneSignal API path with POST for endpoints not yet wrapped by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON payload.'],
        ];
    }

    /**
     * Execute raw POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->required($args, 'path'),
            is_array($args['payload'] ?? null) ? $args['payload'] : [],
        ));
    }
}
