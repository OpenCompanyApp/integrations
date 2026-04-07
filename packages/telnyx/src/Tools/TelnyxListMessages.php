<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List SMS and MMS messages on the Telnyx account.
 *
 * Returns sent and received messages with sender, recipient, body, and status.
 */
class TelnyxListMessages implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_list_messages';
    }

    public function description(): string
    {
        return 'List SMS and MMS messages sent and received on your Telnyx account. Supports filtering by direction, phone number, and date range.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 250).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (starts at 1).'],
            'direction' => ['type' => 'string', 'description' => 'Filter by message direction.', 'enum' => ['inbound', 'outbound']],
            'filter_source' => ['type' => 'string', 'description' => 'Filter by source phone number in E.164 format.'],
            'filter_destination' => ['type' => 'string', 'description' => 'Filter by destination phone number in E.164 format.'],
            'filter_status' => ['type' => 'string', 'description' => 'Filter by delivery status.', 'enum' => ['queued', 'sending', 'sent', 'delivered', 'undeliverable', 'expired']],
        ];
    }

    /**
     * List messages on the Telnyx account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page_number, direction, filter_source, filter_destination, filter_status)
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
            if (isset($args['direction'])) {
                $params['filter[direction]'] = $args['direction'];
            }
            if (isset($args['filter_source'])) {
                $params['filter[source[].number]'] = $args['filter_source'];
            }
            if (isset($args['filter_destination'])) {
                $params['filter[destination[].number]'] = $args['filter_destination'];
            }
            if (isset($args['filter_status'])) {
                $params['filter[status]'] = $args['filter_status'];
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
