<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

class RecurlyCreateAccount implements Tool
{
    /**
     * Create a new RecurlyCreateAccount tool instance.
     *
     * @param RecurlyService $service The Recurly API service.
     */
    public function __construct(
        private RecurlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'recurly_create_account';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new billing account in Recurly with a unique account code, email, and name.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array The parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'code' => ['type' => 'string', 'required' => true, 'description' => 'A unique identifier for the account (e.g., "cust-001").'],
            'email' => ['type' => 'string', 'description' => 'The account email address.'],
            'first_name' => ['type' => 'string', 'description' => 'The account holder\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The account holder\'s last name.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param array $args The tool arguments (code required, email/first_name/last_name optional).
     * @return ToolResult The result containing the created account data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
            }

            if (empty($args['code'])) {
                return ToolResult::error('Account code is required.');
            }

            $result = $this->service->createAccount(
                code: $args['code'],
                email: $args['email'] ?? null,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
