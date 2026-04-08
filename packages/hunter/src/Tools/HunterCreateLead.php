<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Create a new lead in Hunter.io.
 */
class HunterCreateLead implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_create_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new lead in Hunter.io. Requires an email address. Optionally include
        first name, last name, and a list ID to add the lead to a specific lead list.
        Returns the created lead object with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The lead\'s email address.',
            ],
            'first_name' => [
                'type' => 'string',
                'description' => 'The lead\'s first name.',
            ],
            'last_name' => [
                'type' => 'string',
                'description' => 'The lead\'s last name.',
            ],
            'list_id' => [
                'type' => 'integer',
                'description' => 'ID of the lead list to add this lead to.',
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

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->createLead(
                email: $email,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
                listId: $args['list_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
