<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Trigger domain verification in Resend.
 */
class ResendVerifyDomain implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_verify_domain';
    }

    public function description(): string
    {
        return <<<'MD'
        Trigger verification for a domain in Resend. This checks the DNS records for the
        domain and updates its verification status. Returns the domain object with the
        updated status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'domain_id' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The ID of the domain to verify.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Resend integration is not configured.');
            }

            $domainId = $args['domain_id'] ?? '';
            if (empty($domainId)) {
                return ToolResult::error('The "domain_id" parameter is required.');
            }

            $result = $this->service->verifyDomain($domainId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
