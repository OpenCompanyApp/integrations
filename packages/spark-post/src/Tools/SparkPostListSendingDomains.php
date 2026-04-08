<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostListSendingDomains
 *
 * Lists all sending domains configured in the SparkPost account.
 * Returns domain names, verification status, and DKIM/SPF alignment info.
 */
class SparkPostListSendingDomains implements Tool
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
        return 'spark_post_list_sending_domains';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List sending domains configured in SparkPost. Returns domain names along with verification and DKIM signing status.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of sending domains to return (default: 100).'],
        ];
    }

    /**
     * Execute the tool — list sending domains.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult The list of sending domains.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listSendingDomains($limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
