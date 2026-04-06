<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LoopsCreateContact implements Tool
{
    public function __construct(
        private LoopsService $service,
    ) {}

    public function name(): string
    {
        return 'loops_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Loops. Requires an email address. Optionally include first and last name.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'first_name' => ['type' => 'string', 'description' => 'The contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The contact\'s last name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->createContact(
                email: $args['email'],
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
