<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsListForms implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_list_forms';
    }

    public function description(): string
    {
        return 'List Google Forms owned by the authenticated user. Returns form IDs, titles, and metadata. Supports pagination and filtering.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of forms to return per page (default: 20, max: 100).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to fetch the next page of results.'],
            'filter' => ['type' => 'string', 'description' => 'Filter expression. Example: "creator_email = \'user@example.com\'" to filter by creator.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            $result = $this->service->listForms(
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
                pageToken: $args['pageToken'] ?? null,
                filter: $args['filter'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
