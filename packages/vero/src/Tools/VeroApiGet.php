<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Send a GET request to a relative Vero API path.
 *
 * Provides controlled access to documented endpoints not yet wrapped by a
 * first-class tool while rejecting absolute URLs.
 */
class VeroApiGet implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_api_get';
    }

    public function description(): string
    {
        return 'Call a relative Vero API GET path. Use for documented endpoints not yet exposed as first-class tools.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Vero API path such as /campaigns. Absolute URLs are rejected.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters. auth_token is added automatically.'],
        ];
    }

    /**
     * Execute the generic GET tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, params).
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

            return ToolResult::success($this->service->apiGet($path, $args['params'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
