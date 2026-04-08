<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Create a new API key in Resend.
 */
class ResendCreateApiKey implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_create_api_key';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new API key in Resend. You can set a permission scope (full_access or
        sending_access) and optionally restrict the key to a specific domain.
        Returns the created API key object including the key value.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'A descriptive name for the API key.',
            ],
            'permission' => [
                'type'        => 'string',
                'description' => 'Permission scope: "full_access" or "sending_access".',
                'enum'        => ['full_access', 'sending_access'],
            ],
            'domain_id' => [
                'type'        => 'string',
                'description' => 'Domain ID to restrict the key to (only for sending_access).',
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

            $result = $this->service->createApiKey(
                name: $name,
                permission: $args['permission'] ?? null,
                domainId: $args['domain_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
