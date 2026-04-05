<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * List all domains in Resend.
 */
class ResendListDomains implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_list_domains';
    }

    public function description(): string
    {
        return <<<'MD'
        List all domains in the Resend account. Returns an array of domain objects
        including their names, verification status, and regions.
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

            $result = $this->service->listDomains();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
