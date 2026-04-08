<?php

namespace OpenCompany\Integrations\Samsara\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Samsara\SamsaraService;

class SamsaraGetDriver implements Tool
{
    /**
     * Create a new SamsaraGetDriver tool instance.
     */
    public function __construct(
        private SamsaraService $service,
    ) {}

    /**
     * Get the tool slug identifier.
     */
    public function name(): string
    {
        return 'samsara_get_driver';
    }

    /**
     * Get the human-readable description of this tool.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific driver by their Samsara ID, including name, username, email, phone, and driver license details.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Samsara driver ID (e.g., "123456789012345").',
            ],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Samsara integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Driver ID is required.');
            }

            $result = $this->service->getDriver($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
