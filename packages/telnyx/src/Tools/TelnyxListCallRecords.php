<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List call recordings stored on the Telnyx account.
 *
 * Returns recording IDs, call session IDs, download URLs, and duration.
 */
class TelnyxListCallRecords implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_list_call_records';
    }

    public function description(): string
    {
        return 'List call recordings stored on your Telnyx account. Returns recording IDs, associated call sessions, download URLs, duration, and creation timestamps.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 250).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (starts at 1).'],
            'filter_call_session_id' => ['type' => 'string', 'description' => 'Filter recordings by call session ID.'],
            'filter_conference_id' => ['type' => 'string', 'description' => 'Filter recordings by conference ID.'],
        ];
    }

    /**
     * List call recordings on the Telnyx account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page_number, filter_call_session_id, filter_conference_id)
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
            if (isset($args['filter_call_session_id'])) {
                $params['filter[call_session_id]'] = $args['filter_call_session_id'];
            }
            if (isset($args['filter_conference_id'])) {
                $params['filter[conference_id]'] = $args['filter_conference_id'];
            }

            $result = $this->service->listCallRecords($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
