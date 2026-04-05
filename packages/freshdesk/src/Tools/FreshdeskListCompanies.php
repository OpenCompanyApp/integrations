<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customer companies from Freshdesk with optional pagination.
 */
class FreshdeskListCompanies implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_list_companies';
    }

    public function description(): string
    {
        return 'List customer companies from Freshdesk. Supports pagination. Returns company names, domains, and associated contacts.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (max: 100, default: 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $params = array_filter([
                'page'     => $args['page'] ?? null,
                'per_page' => $args['per_page'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listCompanies($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
