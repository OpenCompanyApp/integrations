<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_list_messages
 *
 * Lists email messages in the signed-in user's mailbox via the Microsoft Graph API.
 * Supports OData query parameters for filtering, sorting, and pagination.
 */
class OutlookListMessages implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_list_messages';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List email messages in the signed-in user\'s Outlook mailbox. Supports filtering by subject, sender, date range, and read status. Returns a paginated list of messages with subject, sender, date, and preview.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'top' => [
                'type'        => 'integer',
                'description' => 'Maximum number of messages to return (default: 25, max: 999).',
            ],
            'filter' => [
                'type'        => 'string',
                'description' => 'OData filter expression, e.g. "isRead eq false" or "receivedDateTime ge 2025-01-01T00:00:00Z".',
            ],
            'orderby' => [
                'type'        => 'string',
                'description' => 'OData orderby expression, e.g. "receivedDateTime desc".',
            ],
            'select' => [
                'type'        => 'string',
                'description' => 'Comma-separated list of properties to include, e.g. "subject,from,receivedDateTime".',
            ],
            'skip' => [
                'type'        => 'integer',
                'description' => 'Number of messages to skip (for pagination).',
            ],
        ];
    }

    /**
     * Execute the tool: list messages from the mailbox.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            $params = [];

            if (isset($args['top'])) {
                $params['$top'] = (int) $args['top'];
            }
            if (isset($args['filter'])) {
                $params['$filter'] = $args['filter'];
            }
            if (isset($args['orderby'])) {
                $params['$orderby'] = $args['orderby'];
            }
            if (isset($args['select'])) {
                $params['$select'] = $args['select'];
            }
            if (isset($args['skip'])) {
                $params['$skip'] = (int) $args['skip'];
            }

            $result = $this->service->listMessages($params);

            $messages = $result['value'] ?? [];
            $nextLink = $result['@odata.nextLink'] ?? null;

            $response = [
                'messages'   => $messages,
                'count'      => count($messages),
            ];

            if ($nextLink) {
                $response['hasMore'] = true;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
