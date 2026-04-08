<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new account in Zoho CRM.
 *
 * Maps account fields (account_name, website, phone, industry) to Zoho CRM API field names
 * and wraps them in the Zoho data envelope.
 */
class ZohoCrmCreateAccount implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_create_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new account (organization) in Zoho CRM.
        Provide at least an account name. Other fields (website, phone, industry) are optional.
        Returns the created account with its Zoho CRM ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'account_name' => ['type' => 'string', 'description' => 'Account (company) name.'],
            'website' => ['type' => 'string', 'description' => 'Account website URL.'],
            'phone' => ['type' => 'string', 'description' => 'Account phone number.'],
            'industry' => ['type' => 'string', 'description' => 'Industry type (e.g. Technology, Finance).'],
        ];
    }

    /**
     * Create a new Zoho CRM account with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_name, website, phone, industry)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $fields = [];

            if (! empty($args['account_name'])) {
                $fields['Account_Name'] = $args['account_name'];
            }
            if (! empty($args['website'])) {
                $fields['Website'] = $args['website'];
            }
            if (! empty($args['phone'])) {
                $fields['Phone'] = $args['phone'];
            }
            if (! empty($args['industry'])) {
                $fields['Industry'] = $args['industry'];
            }

            if (empty($fields)) {
                return ToolResult::error('At least one account field is required.');
            }

            $result = $this->service->createAccount($fields);
            $data = $result['data'][0] ?? [];

            if (isset($data['code']) && $data['code'] !== 'SUCCESS') {
                return ToolResult::error($data['message'] ?? 'Failed to create account.');
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
