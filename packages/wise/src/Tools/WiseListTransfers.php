<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list transfers with optional filtering.
 *
 * Supports pagination and filtering by profile or status.
 */
class WiseListTransfers implements Tool
{
    /**
     * Create a new WiseListTransfers instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_list_transfers';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List Wise transfers with optional filtering by profile, status, and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of transfers to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of transfers to skip for pagination.'],
            'profile_id' => ['type' => 'integer', 'description' => 'Filter transfers by profile ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by transfer status (e.g. incoming_payment_waiting, processing, funds_converted, funds_refunded, outgoing_payment_sent).'],
        ];
    }

    /**
     * Execute the tool — list transfers with optional filters.
     *
     * @param array $args Tool arguments for filtering and pagination.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['profile_id'])) {
                $params['profile'] = $args['profile_id'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $transfers = $this->service->listTransfers($params);

            return ToolResult::success($transfers);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
