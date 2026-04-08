<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * List all API keys in Resend.
 */
class ResendListApiKeys implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_list_api_keys';
    }

    public function description(): string
    {
        return <<<'MD'
        List all API keys in the Resend account. Returns an array of API key objects
        with their names, permissions, and creation dates. The actual key values are
        not returned for security reasons.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Resend integration is not configured.');
            }

            $result = $this->service->listApiKeys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
