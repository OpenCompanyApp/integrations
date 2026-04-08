<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single ServiceM8 client by UUID.
 *
 * Returns full client details including contact information and addresses.
 */
class ServiceM8GetClient implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_get_client';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ServiceM8 client by their UUID. Returns client details including name, email, phone, billing address, and notes.';
    }

    public function parameters(): array
    {
        return [
            'uuid' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the client to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            if (empty($args['uuid'])) {
                return ToolResult::error('Client UUID is required.');
            }

            $result = $this->service->getClient($args['uuid']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
