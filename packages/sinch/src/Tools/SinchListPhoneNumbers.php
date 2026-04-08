<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sinch\SinchService;

/**
 * List all rented phone numbers from Sinch.
 *
 * Supports page-based pagination to browse phone numbers
 * associated with the Sinch account.
 */
class SinchListPhoneNumbers implements Tool
{
    /**
     * @param  SinchService  $service  The Sinch API client
     */
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_list_phone_numbers';
    }

    public function description(): string
    {
        return 'List all rented phone numbers in your Sinch account with pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default 0).',
            ],
            'page_size' => [
                'type' => 'integer',
                'description' => 'Number of results per page (default 30, max 100).',
            ],
        ];
    }

    /**
     * List phone numbers from Sinch.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }

            $result = $this->service->listPhoneNumbers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
