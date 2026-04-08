<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AmazonSesListTemplates implements Tool
{
    public function __construct(
        private AmazonSesService $service,
    ) {}

    public function name(): string
    {
        return 'amazonses_list_templates';
    }

    public function description(): string
    {
        return 'List all email templates in Amazon SES. Returns template names and creation timestamps. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of templates to return per page (default: 10, max: 100).'],
            'next_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $result = $this->service->listTemplates(
                pageSize: isset($args['page_size']) ? (int) $args['page_size'] : null,
                nextToken: $args['next_token'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
