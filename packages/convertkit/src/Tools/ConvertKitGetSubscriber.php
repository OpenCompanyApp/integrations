<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single ConvertKit subscriber by ID.
 *
 * Retrieves detailed information about a specific subscriber,
 * including their email, name, state, and subscribed tags.
 */
class ConvertKitGetSubscriber implements Tool
{
    /**
     * Create a new ConvertKitGetSubscriber tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_get_subscriber';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a single ConvertKit subscriber by their subscriber ID.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ConvertKit subscriber ID.'],
        ];
    }

    /**
     * Execute the tool: fetch a single subscriber from ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            if (empty($args['subscriber_id'])) {
                return ToolResult::error('subscriber_id is required.');
            }

            $result = $this->service->getSubscriber((int) $args['subscriber_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
