<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zoho CRM contacts by criteria or email.
 *
 * Supports Zoho CRM search criteria syntax such as {@code (Email:equals:john@example.com)}
 * or simple email-based lookup via the {@code email} parameter.
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
        Search Zoho CRM contacts by criteria or email.
        Use "criteria" for structured queries like (Email:equals:john@example.com).
        Use "email" as a shortcut to search by email address.
        Returns matching contact records.
        MD;
    }

    public function parameters(): array
    {
        return [
            'criteria' => ['type' => 'string', 'description' => 'Search criteria expression, e.g. (Email:equals:john@example.com).'],
            'email' => ['type' => 'string', 'description' => 'Email address to search for (shortcut for criteria).'],
        ];
    }

    /**
     * Search Zoho CRM contacts using criteria or email.
     *
     * @param  array<string, mixed>  $args  Tool arguments (criteria, email)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $params = [];

            if (! empty($args['criteria'])) {
                $params['criteria'] = $args['criteria'];
            } elseif (! empty($args['email'])) {
                $params['criteria'] = '(Email:equals:' . $args['email'] . ')';
            }

            if (empty($params)) {
                return ToolResult::error('Provide either criteria or email to search.');
            }

            $result = $this->service->searchContacts($params);
            $data = $result['data'] ?? [];

            return ToolResult::success([
                'results' => $data,
                'total' => count($data),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
