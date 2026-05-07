<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE narrowcast progress.
 *
 * Checks progress for a narrowcast request ID.
 */
class LineGetNarrowcastProgress implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_narrowcast_progress';
    }

    public function description(): string
    {
        return 'Get the progress status of a LINE narrowcast request.';
    }

    public function parameters(): array
    {
        return ['request_id' => ['type' => 'string', 'required' => true, 'description' => 'Narrowcast request ID.']];
    }

    /**
     * Get narrowcast progress.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getNarrowcastProgress((string) ($args['request_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
