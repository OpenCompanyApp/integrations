<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single subscriber from a Beehiiv publication by subscription ID.
 */
class BeehiivGetSubscriber implements Tool
{
    /**
     * Create a new BeehiivGetSubscriber tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_get_subscriber';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single subscriber from your Beehiiv publication by their subscription ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'The subscription ID of the subscriber to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a subscriber from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $result = $this->service->getSubscriber($args['subscription_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
