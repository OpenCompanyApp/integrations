<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List account-level RingCentral call log records.
 */
class RingCentralListAccountCalls extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_list_account_calls';
    }

    public function description(): string
    {
        return 'List account-level call log records for RingCentral. Admin permissions may be required.';
    }

    public function parameters(): array
    {
        return [
            'dateFrom' => ['type' => 'string', 'description' => 'Start date for filtering.'],
            'dateTo' => ['type' => 'string', 'description' => 'End date for filtering.'],
            'direction' => ['type' => 'string', 'description' => 'Inbound, Outbound, or All.'],
            'type' => ['type' => 'string', 'description' => 'Voice, Fax, or All.'],
            'phoneNumber' => ['type' => 'string', 'description' => 'Filter by caller or receiver phone number.'],
            'extensionNumber' => ['type' => 'string', 'description' => 'Filter by extension number.'],
            'perPage' => ['type' => 'integer', 'description' => 'Records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Fetch account call logs.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listAccountCalls($this->only($args, ['dateFrom', 'dateTo', 'direction', 'type', 'phoneNumber', 'extensionNumber', 'perPage', 'page'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
