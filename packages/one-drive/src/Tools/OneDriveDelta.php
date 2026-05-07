<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Track changes in a OneDrive drive.
 *
 * Wraps the Microsoft Graph root delta endpoint.
 */
class OneDriveDelta implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_delta';
    }

    public function description(): string
    {
        return 'List changes in the signed-in user\'s OneDrive. Continue with @odata.nextLink or @odata.deltaLink values returned by Graph.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional delta query parameters. For exact nextLink URLs, use onedrive_api_get with the relative path from the link.'],
        ];
    }

    /**
     * Fetch a drive delta page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (params)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            return ToolResult::success($this->service->delta(is_array($args['params'] ?? null) ? $args['params'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
