<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative RingCentral API POST endpoint.
 */
class RingCentralApiPost extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_api_post';
    }

    public function description(): string
    {
        return 'Call a relative RingCentral REST API POST path with a JSON body. Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative RingCentral API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /**
     * Execute a relative POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, payload)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['path'])) {
                return ToolResult::error('path is required.');
            }

            return ToolResult::success($this->service->apiPost((string) $args['path'], is_array($args['payload'] ?? null) ? $args['payload'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
