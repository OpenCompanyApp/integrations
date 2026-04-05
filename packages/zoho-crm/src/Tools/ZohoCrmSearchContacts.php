<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zoho CRM contacts by criteria, email, or phone.
 *
 * Supports Zoho CRM's criteria expression syntax (e.g. `(Last_Name:equals:Smith)`)
 * as well as direct email and phone searches.
 */
class ZohoCrmSearchContacts implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_search_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        Search contacts in Zoho CRM using criteria, email, or phone.
        Use criteria for structured queries like "(Last_Name:equals:Smith)" or "(Email:contains:example.com)".
        Email and phone parameters provide simpler search alternatives.
        MD;
    }

    public function parameters(): array
    {
        return [
            'criteria' => ['type' => 'string', 'description' => 'Search criteria expression, e.g. "(Last_Name:equals:Smith)" or "(Email:contains:acme)".'],
            'email' => ['type' => 'string', 'description' => 'Email address to search for.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number to search for.'],
        ];
    }

    /**
     * Search Zoho CRM contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (criteria, email, phone)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $criteria = $args['criteria'] ?? null;
            $email = $args['email'] ?? null;
            $phone = $args['phone'] ?? null;

            if ($criteria === null && $email === null && $phone === null) {
                return ToolResult::error('At least one search parameter is required (criteria, email, or phone).');
            }

            $result = $this->service->searchContacts(
                is_string($criteria) && $criteria !== '' ? $criteria : null,
                is_string($email) && $email !== '' ? $email : null,
                is_string($phone) && $phone !== '' ? $phone : null,
            );

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
                'count' => count($data),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
