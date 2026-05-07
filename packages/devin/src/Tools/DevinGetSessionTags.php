<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Read tags attached to a Devin session.
 *
 * Uses the current v3 session tags endpoint.
 */
class DevinGetSessionTags implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_get_session_tags';
    }

    public function description(): string
    {
        return 'Get tags attached to a Devin v3 session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID.'],
        ];
    }

    /**
     * Get session tags.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->getSessionTags($args['session_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
