<?php

namespace OpenCompany\Integrations\Shopify\Tools;

use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Shopify custom collection.
 */
class ShopifyCreateCustomCollection implements Tool
{
    /**
     * @param  ShopifyService  $service  The Shopify API client
     */
    public function __construct(
        private ShopifyService $service,
    ) {}

    public function name(): string
    {
        return 'shopify_create_custom_collection';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Shopify custom collection.
        Supports title and body_html (description).
        Products can be added to the collection after creation.
        MD;
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'description' => 'Collection title.'],
            'body_html' => ['type' => 'string', 'description' => 'Collection description (HTML allowed).'],
        ];
    }

    /**
     * Create a custom collection in Shopify.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Shopify integration is not configured.');
            }

            $data = [];

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }
            if (isset($args['body_html'])) {
                $data['body_html'] = $args['body_html'];
            }

            $result = $this->service->createCustomCollection($data);
            $collection = $result['custom_collection'] ?? $result;

            return ToolResult::success([
                'id' => $collection['id'] ?? null,
                'title' => $collection['title'] ?? '',
                'handle' => $collection['handle'] ?? '',
                'published_at' => $collection['published_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
