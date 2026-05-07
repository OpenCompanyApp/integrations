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
     *
     * @param  MailerLiteService  $service  MailerLite API client.
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
        return 'List subscribers from MailerLite. Supports cursor pagination, status filtering, and groups include.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of subscribers to return (default: 25).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, unsubscribed, unconfirmed, bounced, junk.'],
            'include' => ['type' => 'string', 'description' => 'Additional resource include. Currently groups is supported.'],
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

            $params = [];

            foreach (['cursor', 'limit', 'include'] as $key) {
                if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                    $params[$key] = $args[$key];
                }
            }

            if (($args['status'] ?? null) !== null && $args['status'] !== '') {
                $params['filter[status]'] = $args['status'];
            }

            $result = $this->service->listSubscribers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
