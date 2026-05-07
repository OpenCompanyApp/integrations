<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative SignNow API DELETE endpoint.
 */
class SignNowApiDelete extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_api_delete';
    }

    public function description(): string
    {
        return 'Call a relative SignNow API DELETE path. Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative SignNow API path.'],
            'payload' => ['type' => 'object', 'description' => 'Optional JSON body.'],
        ];
    }

    /**
     * Execute a relative DELETE request.
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

            return ToolResult::success($this->service->apiDelete((string) $args['path'], is_array($args['payload'] ?? null) ? $args['payload'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
