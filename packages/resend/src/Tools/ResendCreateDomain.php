<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Create a new domain in Resend.
 */
class ResendCreateDomain implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_create_domain';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new domain in Resend. You can optionally specify a region for the domain
        (us-east-1 or eu-west-1). Returns the created domain object including DNS records
        that need to be configured.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Domain name (e.g. "example.com").',
            ],
            'region' => [
                'type'        => 'string',
                'description' => 'Region for the domain: "us-east-1" or "eu-west-1".',
                'enum'        => ['us-east-1', 'eu-west-1'],
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

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $result = $this->service->createDomain(
                name: $name,
                region: $args['region'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
