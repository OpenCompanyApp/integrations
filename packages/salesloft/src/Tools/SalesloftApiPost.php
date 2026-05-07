<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Salesloft API POST endpoint.
 */
class SalesloftApiPost extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_api_post';
    }

    public function description(): string
    {
        return 'Call a relative Salesloft API POST path. Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Salesloft API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON body.'],
        ];
    }

    /**
     * Execute a relative POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
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
