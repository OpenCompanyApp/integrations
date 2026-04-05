<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current user account summary from Constant Contact.
 *
 * Returns account details including the user's name, email,
 * company information, and plan details.
 */
class ConstantContactGetCurrentUser implements Tool
{
    /**
     * Create a new ConstantContactGetCurrentUser tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_get_current_user';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the current user account summary from Constant Contact, including name and plan details.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: get the current user account summary.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
