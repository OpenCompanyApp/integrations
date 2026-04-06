<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostGetCurrentUser
 *
 * Retrieves the current SparkPost account information, including
 * account status, subscription level, and usage details.
 */
class SparkPostGetCurrentUser implements Tool
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
        return 'spark_post_get_current_user';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Get current SparkPost account information. Returns account status, subscription plan, and usage details.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get account information.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     * @return ToolResult The account information.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $result = $this->service->getAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
