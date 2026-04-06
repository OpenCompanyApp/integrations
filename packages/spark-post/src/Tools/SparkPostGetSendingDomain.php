<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostGetSendingDomain
 *
 * Retrieves detailed information for a single sending domain, including
 * verification status, DKIM keys, and SPF alignment.
 */
class SparkPostGetSendingDomain implements Tool
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
        return 'spark_post_get_sending_domain';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Get details for a specific sending domain in SparkPost. Returns verification status, DKIM signing info, and SPF records.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'required' => true, 'description' => 'The sending domain name to look up (e.g., "example.com").'],
        ];
    }

    /**
     * Execute the tool — get a single sending domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult The sending domain details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $domain = $args['domain'] ?? '';
            if (empty($domain)) {
                return ToolResult::error('The "domain" parameter is required.');
            }

            $result = $this->service->getSendingDomain($domain);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
