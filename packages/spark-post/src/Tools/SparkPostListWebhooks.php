<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostListWebhooks
 *
 * Lists webhooks configured in the SparkPost account. Supports
 * pagination via limit and offset parameters.
 */
class SparkPostListWebhooks implements Tool
{
    /**
     * @param  SparkPostService  $service  The SparkPost API service instance.
     */
    public function __construct(
        private SparkPostService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'spark_post_list_webhooks';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List webhooks configured in SparkPost. Returns webhook IDs, target URLs, and subscribed event types.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of webhooks to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of webhooks to skip for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the tool — list webhooks.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult The list of webhooks.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $result = $this->service->listWebhooks($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
