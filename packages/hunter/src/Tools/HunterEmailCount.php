<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Get the number of email addresses found for a domain using the Hunter.io API.
 */
class HunterEmailCount implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_email_count';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the total number of email addresses Hunter.io has found for a domain.
        Returns counts broken down by email type (personal, generic) and department.
        This endpoint does not consume API credits.
        MD;
    }

    public function parameters(): array
    {
        return [
            'domain' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The domain to count emails for (e.g., "example.com").',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Hunter integration is not configured.');
            }

            $domain = $args['domain'] ?? '';
            if (empty($domain)) {
                return ToolResult::error('The "domain" parameter is required.');
            }

            $result = $this->service->emailCount($domain);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
