<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vonage\VonageService;

/**
 * Search and list SMS messages via the Vonage (Nexmo) Messages Search API.
 *
 * Retrieves sent/received SMS messages matching the given criteria.
 *
 * @see https://developer.vonage.com/en/api/sms#search-messages
 */
class VonageListSms implements Tool
{
    public function __construct(
        private VonageService $service,
    ) {}

    public function name(): string
    {
        return 'vonage_list_sms';
    }

    public function description(): string
    {
        return 'Search and list SMS messages from your Vonage account. Requires a date in ISO format.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'required' => true, 'description' => 'Date to search in ISO format (YYYY-MM-DD, e.g., "2025-01-15").'],
            'to' => ['type' => 'string', 'description' => 'Filter by recipient phone number in E.164 format.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vonage integration is not configured.');
            }

            $params = [
                'date' => $args['date'],
            ];

            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }

            $result = $this->service->listSms($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
