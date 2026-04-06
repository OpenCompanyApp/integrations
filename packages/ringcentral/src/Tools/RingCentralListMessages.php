<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list messages from the RingCentral message store.
 *
 * Supports filtering by message type, date range, read status, and pagination.
 */
class RingCentralListMessages implements Tool
{
    /**
     * Create a new RingCentralListMessages tool instance.
     *
     * @param  RingCentralService  $service  The RingCentral API service.
     */
    public function __construct(
        private RingCentralService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'ringcentral_list_messages';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List messages from the RingCentral message store. Supports filtering by type (SMS, Fax, VoiceMail), date range, read status, and direction. Returns paginated message records.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'messageType' => ['type' => 'string', 'description' => 'Filter by message type: Sms, Fax, VoiceMail, Pager, or All (default: All).'],
            'dateFrom' => ['type' => 'string', 'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01T00:00:00Z").'],
            'dateTo' => ['type' => 'string', 'description' => 'End date for filtering (ISO 8601, e.g., "2025-01-31T23:59:59Z").'],
            'direction' => ['type' => 'string', 'description' => 'Filter by direction: Inbound, Outbound, or All.'],
            'readStatus' => ['type' => 'string', 'description' => 'Filter by read status: Read, Unread, or All.'],
            'perPage' => ['type' => 'integer', 'description' => 'Number of records per page (default: 100, max: 1000).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array  $args  The tool arguments matching parameter definitions.
     * @return ToolResult The result containing message records or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RingCentral integration is not configured.');
            }

            $params = [];
            $keys = ['messageType', 'dateFrom', 'dateTo', 'direction', 'readStatus', 'perPage', 'page'];
            foreach ($keys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
