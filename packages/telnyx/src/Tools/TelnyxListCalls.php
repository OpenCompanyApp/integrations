<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List voice calls on the Telnyx account.
 *
 * Returns call sessions with IDs, status, from/to numbers, and duration.
 */
class TelnyxListCalls implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_list_calls';
    }

    public function description(): string
    {
        return 'List voice calls made on your Telnyx account. Returns call session IDs, status, participants, and duration.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 250).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (starts at 1).'],
            'filter_status' => ['type' => 'string', 'description' => 'Filter by call session status.', 'enum' => ['initiating', 'ringing', 'in-progress', 'no-answer', 'completed', 'failed', 'busy', 'timeout']],
        ];
    }

    /**
     * List voice calls on the Telnyx account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page_number, filter_status)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telnyx integration is not configured.');
            }

            $params = [];

            if (isset($args['page_size'])) {
                $params['page[size]'] = (int) $args['page_size'];
            }
            if (isset($args['page_number'])) {
                $params['page[number]'] = (int) $args['page_number'];
            }
            if (isset($args['filter_status'])) {
                $params['filter[status]'] = $args['filter_status'];
            }

            $result = $this->service->listCalls($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
