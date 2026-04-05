<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Retrieve a single domain by ID from Resend.
 */
class ResendGetDomain implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_get_domain';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single domain by its ID from Resend. Returns the domain object
        including verification status and DNS records.
        MD;
    }

    public function parameters(): array
    {
        return [
            'domain_id' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The ID of the domain to retrieve.',
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

            $result = $this->service->getDomain($domainId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
