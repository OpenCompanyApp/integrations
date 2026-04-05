<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a record from an Apify key-value store.
 *
 * Key-value stores contain records such as actor outputs (e.g., "OUTPUT" key),
 * screenshots, or other named results. This tool retrieves a specific record
 * by its key.
 */
class ApifyGetRecord implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_record';
    }

    public function description(): string
    {
        return 'Get a record from an Apify key-value store by its key. Common keys include "OUTPUT" for actor results, "SCREENSHOT" for page screenshots, or custom keys set by actor runs.';
    }

    public function parameters(): array
    {
        return [
            'storeId' => ['type' => 'string', 'required' => true, 'description' => 'The key-value store ID (e.g., from a run\'s defaultKeyValueStoreId).'],
            'key' => ['type' => 'string', 'required' => true, 'description' => 'The record key (e.g., "OUTPUT", "SCREENSHOT", or a custom key).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $result = $this->service->getRecord($args['storeId'], $args['key']);

            if (is_array($result)) {
                return ToolResult::success([
                    'storeId' => $args['storeId'],
                    'key' => $args['key'],
                    'type' => 'json',
                    'data' => $result,
                ]);
            }

            return ToolResult::success([
                'storeId' => $args['storeId'],
                'key' => $args['key'],
                'type' => 'text',
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
