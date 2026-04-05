<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new deal in Zoho CRM.
 *
 * Maps deal fields (deal_name, amount, stage, closing_date, account_id) to Zoho CRM API
 * field names and wraps them in the Zoho data envelope.
 */
class ZohoCrmCreateDeal implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_create_deal';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new deal (opportunity) in Zoho CRM.
        Provide at least a deal name and stage. Other fields (amount, closing_date, account_id) are optional.
        Returns the created deal with its Zoho CRM ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'deal_name' => ['type' => 'string', 'description' => 'Deal name.'],
            'amount' => ['type' => 'number', 'description' => 'Deal amount.'],
            'stage' => ['type' => 'string', 'description' => 'Deal stage (e.g. Qualification, Negotiation, Closed Won).'],
            'closing_date' => ['type' => 'string', 'description' => 'Expected closing date (YYYY-MM-DD).'],
            'account_id' => ['type' => 'string', 'description' => 'Zoho CRM account ID to associate with the deal.'],
        ];
    }

    /**
     * Create a new Zoho CRM deal with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (deal_name, amount, stage, closing_date, account_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $fields = [];

            if (! empty($args['deal_name'])) {
                $fields['Deal_Name'] = $args['deal_name'];
            }
            if (isset($args['amount'])) {
                $fields['Amount'] = $args['amount'];
            }
            if (! empty($args['stage'])) {
                $fields['Stage'] = $args['stage'];
            }
            if (! empty($args['closing_date'])) {
                $fields['Closing_Date'] = $args['closing_date'];
            }
            if (! empty($args['account_id'])) {
                $fields['Account_Name'] = ['id' => $args['account_id']];
            }

            if (empty($fields)) {
                return ToolResult::error('At least one deal field is required.');
            }

            $result = $this->service->createDeal($fields);
            $data = $result['data'][0] ?? [];

            if (isset($data['code']) && $data['code'] !== 'SUCCESS') {
                return ToolResult::error($data['message'] ?? 'Failed to create deal.');
            }

            return ToolResult::success([
                'id' => $data['details']['id'] ?? '',
                'code' => $data['code'] ?? 'SUCCESS',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
