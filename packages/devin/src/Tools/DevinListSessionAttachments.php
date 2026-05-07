<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * List files and links attached to a Devin session.
 *
 * Uses the current v3 session attachments endpoint.
 */
class DevinListSessionAttachments implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_list_session_attachments';
    }

    public function description(): string
    {
        return 'List attachments for a Devin v3 session with optional cursor pagination.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID.'],
            'first' => ['type' => 'integer', 'description' => 'Maximum records to return.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for the next page.'],
        ];
    }

    /**
     * List session attachments.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id, optional first, after).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $sessionId = $args['session_id'];
            unset($args['session_id']);

            return ToolResult::success($this->service->listSessionAttachments($sessionId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
