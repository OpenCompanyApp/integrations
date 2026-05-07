<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List phone numbers provisioned on the RingCentral account.
 */
class RingCentralListAccountPhoneNumbers extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_list_account_phone_numbers';
    }

    public function description(): string
    {
        return 'List RingCentral account phone numbers, including usage type, phone number type, and assignment metadata.';
    }

    public function parameters(): array
    {
        return [
            'usageType' => ['type' => 'string', 'description' => 'Filter by usage type such as MainCompanyNumber or DirectNumber.'],
            'status' => ['type' => 'string', 'description' => 'Filter by phone number status.'],
            'perPage' => ['type' => 'integer', 'description' => 'Records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Fetch account phone numbers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listAccountPhoneNumbers($this->only($args, ['usageType', 'status', 'perPage', 'page'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
