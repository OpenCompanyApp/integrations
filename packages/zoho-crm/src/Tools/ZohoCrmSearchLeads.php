<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zoho CRM leads by criteria, email, phone, or keyword.
 *
 * Supports Zoho CRM's criteria expression syntax (e.g. `(First_Name:equals:John)`)
 * as well as direct email, phone, and word searches.
 */
class ZohoCrmSearchLeads implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_search_leads';
    }

    public function description(): string
    {
        return <<<'MD'
        Search leads in Zoho CRM using criteria, email, phone, or a keyword.
        Use criteria for structured queries like "(First_Name:equals:John)" or "(Last_Name:starts_with:Sm)".
        Email, phone, and word parameters provide simpler search alternatives.
        MD;
    }

    public function parameters(): array
    {
        return [
            'criteria' => ['type' => 'string', 'description' => 'Search criteria expression, e.g. "(First_Name:equals:John)" or "(Company:starts_with:Acme)".'],
            'email' => ['type' => 'string', 'description' => 'Email address to search for.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number to search for.'],
            'word' => ['type' => 'string', 'description' => 'Keyword to search across lead fields.'],
        ];
    }

    /**
     * Search Zoho CRM leads.
     *
     * @param  array<string, mixed>  $args  Tool arguments (criteria, email, phone, word)
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
            $word = $args['word'] ?? null;

            if ($criteria === null && $email === null && $phone === null && $word === null) {
                return ToolResult::error('At least one search parameter is required (criteria, email, phone, or word).');
            }

            $result = $this->service->searchLeads(
                is_string($criteria) && $criteria !== '' ? $criteria : null,
                is_string($email) && $email !== '' ? $email : null,
                is_string($phone) && $phone !== '' ? $phone : null,
                is_string($word) && $word !== '' ? $word : null,
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
