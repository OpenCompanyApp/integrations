<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated ConvertKit account information.
 *
 * Retrieves the current user's account details including name, email,
 * and plan information. Useful for verifying API credentials and
 * displaying account context.
 */
class ConvertKitGetCurrentUser implements Tool
{
    /**
     * Create a new ConvertKitGetCurrentUser tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_get_current_user';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated ConvertKit account information, including account name, email, and plan details.';
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
     * Execute the tool: fetch current account from ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            $result = $this->service->getAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
