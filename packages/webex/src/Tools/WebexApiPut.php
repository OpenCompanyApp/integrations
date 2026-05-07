<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Webex API PUT endpoint.
 */
class WebexApiPut extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_api_put';
    }

    public function description(): string
    {
        return 'Call a relative Webex API PUT path with a JSON body. Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Webex API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /**
     * Execute a relative PUT request.
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

            return ToolResult::success($this->service->apiPut((string) $args['path'], is_array($args['payload'] ?? null) ? $args['payload'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
