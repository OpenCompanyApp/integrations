<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Send a PUT request to a relative Vero API path.
 *
 * Provides controlled access to documented endpoints not yet wrapped by a
 * first-class tool while rejecting absolute URLs.
 */
class VeroApiPut implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_api_put';
    }

    public function description(): string
    {
        return 'Call a relative Vero API PUT path. Use for documented endpoints not yet exposed as first-class tools.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Vero API path such as /users/tags/edit. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body. auth_token is added as a query parameter automatically.'],
        ];
    }

    /**
     * Execute the generic PUT tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, payload).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $path = $args['path'] ?? '';

            if ($path === '') {
                return ToolResult::error('Path is required.');
            }

            return ToolResult::success($this->service->apiPut($path, $args['payload'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
