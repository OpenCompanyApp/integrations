<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List phone numbers on the Telnyx account.
 *
 * Returns phone number IDs, phone numbers in E.164 format, and their status.
 */
class TelnyxListPhoneNumbers implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_list_phone_numbers';
    }

    public function description(): string
    {
        return 'List phone numbers on your Telnyx account. Returns phone number IDs, numbers in E.164 format, status, and billing details.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 250).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (starts at 1).'],
            'filter_phone_number' => ['type' => 'string', 'description' => 'Filter by phone number in E.164 format (e.g., "+12345678900").'],
            'filter_status' => ['type' => 'string', 'description' => 'Filter by phone number status.', 'enum' => ['purchase_pending', 'purchase_failed', 'port_pending', 'port_failed', 'active', 'deleted']],
        ];
    }

    /**
     * List phone numbers on the Telnyx account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page_number, filter_phone_number, filter_status)
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
            if (isset($args['filter_phone_number'])) {
                $params['filter[phone_number]'] = $args['filter_phone_number'];
            }
            if (isset($args['filter_status'])) {
                $params['filter[status]'] = $args['filter_status'];
            }

            $result = $this->service->listPhoneNumbers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
