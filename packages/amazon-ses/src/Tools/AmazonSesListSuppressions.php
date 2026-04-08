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
        return 'List email addresses on the suppression list for a specific configuration set in Amazon SES. Suppressed addresses will not receive emails.';
    }

    public function parameters(): array
    {
        return [
            'configuration_set' => ['type' => 'string', 'required' => true, 'description' => 'The configuration set name to retrieve suppressions for.'],
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of suppressed addresses to return per page.'],
            'next_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $result = $this->service->listSuppressions(
                configurationSet: $args['configuration_set'],
                pageSize: isset($args['page_size']) ? (int) $args['page_size'] : null,
                nextToken: $args['next_token'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
