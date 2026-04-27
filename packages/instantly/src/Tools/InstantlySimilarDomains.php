<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get similar domains for DFY orders.
 */
class InstantlySimilarDomains implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_similar_domains';
    }

    public function description(): string
    {
        return 'Get similar domains for DFY orders.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'string', 'required' => false, 'description' => 'JSON request body'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = is_string($args['body'] ?? '') ? json_decode($args['body'], true) : ($args['body'] ?? []); $result = $this->service->getSimilarDomains($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
