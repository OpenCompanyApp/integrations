<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list subscribers from MailerLite with pagination and status filtering.
 */
class MailerLiteListSubscribers implements Tool
{
    /**
     * Create a new list subscribers tool instance.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_list_subscribers';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List subscribers from MailerLite. Supports pagination and filtering by status (active, unsubscribed, etc.).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of subscribers per page (default: 25, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, unsubscribed, unconfirmed, bounced, junk.'],
        ];
    }

    /**
     * Execute the list subscribers tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $status = $args['status'] ?? null;

            $result = $this->service->listSubscribers($page, $limit, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
