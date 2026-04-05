<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Get a single Klaviyo flow by ID.
 */
class KlaviyoGetFlow implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_get_flow';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Klaviyo flow by its ID.
        Returns the flow's name, status, trigger type, and other metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'flow_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo flow ID.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $flowId = $args['flow_id'] ?? '';
            if (empty($flowId)) {
                return ToolResult::error('The "flow_id" parameter is required.');
            }

            $result = $this->service->getFlow($flowId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
