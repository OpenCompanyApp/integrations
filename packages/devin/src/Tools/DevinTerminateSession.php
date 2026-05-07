<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Terminate an active Devin session.
 *
 * Uses the current v3 session delete endpoint or the legacy v1 terminate
 * endpoint when configured for v1.
 */
class DevinTerminateSession implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_terminate_session';
    }

    public function description(): string
    {
        return 'Terminate an active Devin session by ID.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID to terminate.'],
            'archive' => ['type' => 'boolean', 'description' => 'For v3, archive the session while terminating so it is preserved for reference.'],
        ];
    }

    /**
     * Terminate the session.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id, optional archive).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->terminateSession($args['session_id'], (bool) ($args['archive'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
