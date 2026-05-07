<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AmazonSesListSuppressions implements Tool
{
    public function __construct(
        private AmazonSesService $service,
    ) {}

    public function name(): string
    {
        return 'amazonses_list_suppressions';
    }

    public function description(): string
    {
        return 'List email addresses on the Amazon SES account-level suppression list. Suppressed addresses will not receive emails.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of suppressed addresses to return per page.'],
            'next_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page of results.'],
            'reason' => ['type' => 'string', 'enum' => ['BOUNCE', 'COMPLAINT'], 'description' => 'Optional suppression reason filter.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $result = $this->service->listSuppressions(
                pageSize: isset($args['page_size']) ? (int) $args['page_size'] : null,
                nextToken: $args['next_token'] ?? null,
                reason: $args['reason'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
