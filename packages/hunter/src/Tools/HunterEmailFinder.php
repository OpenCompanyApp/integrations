<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Find the most likely email address for a person using the Hunter.io API.
 */
class HunterEmailFinder implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_email_finder';
    }

    public function description(): string
    {
        return <<<'MD'
        Find the most likely professional email address for a person based on their
        name and company domain. Returns the email with a confidence score and sources
        where the email was found.
        MD;
    }

    public function parameters(): array
    {
        return [
            'domain' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The company domain (e.g., "example.com").',
            ],
            'first_name' => [
                'type' => 'string',
                'description' => 'The person\'s first name.',
            ],
            'last_name' => [
                'type' => 'string',
                'description' => 'The person\'s last name.',
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

            $result = $this->service->emailFinder(
                domain: $domain,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
