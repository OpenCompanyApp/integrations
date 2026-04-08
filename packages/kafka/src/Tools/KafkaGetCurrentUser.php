<?php

namespace OpenCompany\Integrations\Kafka\Tools;

use OpenCompany\Integrations\Kafka\KafkaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Confluent Cloud user.
 *
 * Useful for verifying that credentials are valid and identifying the connected account.
 */
class KafkaGetCurrentUser implements Tool
{
    /**
     * Create a new KafkaGetCurrentUser tool instance.
     *
     * @param  KafkaService  $service  The Kafka API service
     */
    public function __construct(
        private KafkaService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'kafka_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Confluent Cloud user. Useful for verifying credentials and identifying the connected account.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kafka integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
