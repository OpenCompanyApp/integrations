<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customer contacts from Freshdesk with optional pagination.
 */
class FreshdeskListContacts implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_list_contacts';
    }

    public function description(): string
    {
        return 'List customer contacts from Freshdesk. Supports pagination. Returns contact names, emails, and company associations.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (max: 100, default: 30).'],
            'email'    => ['type' => 'string',  'description' => 'Filter by contact email.'],
            'company_id' => ['type' => 'integer', 'description' => 'Filter by company ID.'],
            'mobile'   => ['type' => 'string',  'description' => 'Filter by mobile number.'],
            'phone'    => ['type' => 'string',  'description' => 'Filter by phone number.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $params = array_filter([
                'page'       => $args['page'] ?? null,
                'per_page'   => $args['per_page'] ?? null,
                'email'      => $args['email'] ?? null,
                'company_id' => $args['company_id'] ?? null,
                'mobile'     => $args['mobile'] ?? null,
                'phone'      => $args['phone'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
