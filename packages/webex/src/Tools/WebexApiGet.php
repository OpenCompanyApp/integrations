<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Webex API GET endpoint.
 */
class WebexApiGet extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_api_get';
    }

    public function description(): string
    {
        return 'Call a relative Webex API GET path, such as "/rooms". Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Webex API path.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute a relative GET request.
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

            return ToolResult::success($this->service->apiGet((string) $args['path'], is_array($args['params'] ?? null) ? $args['params'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
