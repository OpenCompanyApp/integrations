<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM account by ID.
 *
 * Returns the account's fields.
 */
class ZohoCrmGetAccount implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_get_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zoho CRM account by its ID.
        Returns all account fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM account ID.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM account by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $accountId = $args['account_id'] ?? '';
            if (empty($accountId)) {
                return ToolResult::error('account_id is required.');
            }

            $result = $this->service->getAccount($accountId);

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
