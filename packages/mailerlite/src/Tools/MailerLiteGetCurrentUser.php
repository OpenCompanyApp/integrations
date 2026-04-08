<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated MailerLite user / account info.
 */
class MailerLiteGetCurrentUser implements Tool
{
    /**
     * Create a new get current user tool instance.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get the currently authenticated MailerLite account information. Useful for verifying API credentials.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
