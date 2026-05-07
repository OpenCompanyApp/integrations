<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Devin session by ID.
 *
 * Works with current v3 organization sessions and legacy v1 sessions.
 */
class DevinGetSession implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_get_session';
    }

    public function description(): string
    {
        return 'Retrieve details and current status of a Devin session. Use this to check progress on a task, view the session state, or get the output.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID. Current v3 IDs are usually prefixed with devin-.'],
        ];
    }

    /**
     * Fetch the session details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->getSession($args['session_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
