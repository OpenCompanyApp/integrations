<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Etsy\EtsyService;

/**
 * Create a new listing in the Etsy shop.
 */
class EtsyCreateListing implements Tool
{
    /**
     * @param  EtsyService  $service  The Etsy Open API client.
     */
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_create_listing';
    }

    public function description(): string
    {
        return 'Create a new listing in the Etsy shop. Requires a title, description, price, quantity, and shipping profile ID.';
    }

    public function parameters(): array
    {
        return [
            'title' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Listing title (max 140 characters).',
            ],
            'description' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Listing description (max 500 characters for initial draft).',
            ],
            'price' => [
                'type' => 'number',
                'required' => true,
                'description' => 'Listing price (must be greater than 0).',
            ],
            'quantity' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'Stock quantity (must be at least 1).',
            ],
            'shipping_profile_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'ID of the shipping profile to assign to this listing.',
            ],
            'taxonomy_id' => [
                'type' => 'integer',
                'description' => 'Etsy taxonomy (category) ID for the listing.',
            ],
            'tags' => [
                'type' => 'array',
                'description' => 'Tags for the listing (up to 13 tags, max 20 characters each).',
                'items' => ['type' => 'string'],
            ],
            'who_made' => [
                'type' => 'string',
                'enum' => ['i_did', 'collective', 'someone_else'],
                'description' => 'Who made this item. Defaults to "i_did" if not specified.',
            ],
            'when_made' => [
                'type' => 'string',
                'description' => 'When the item was made (e.g., "made_to_order", "2020_2024"). Defaults to "made_to_order".',
            ],
            'is_supply' => [
                'type' => 'boolean',
                'description' => 'Whether this listing is a supply (true) or a finished product (false).',
            ],
        ];
    }

    /**
     * Create a draft listing with the supplied listing fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('Title is required.');
            }

            $description = $args['description'] ?? '';
            if (empty($description)) {
                return ToolResult::error('Description is required.');
            }

            $price = $args['price'] ?? null;
            if ($price === null || (float) $price <= 0) {
                return ToolResult::error('Price is required and must be greater than 0.');
            }

            $quantity = $args['quantity'] ?? null;
            if ($quantity === null || (int) $quantity < 1) {
                return ToolResult::error('Quantity is required and must be at least 1.');
            }

            $shippingProfileId = $args['shipping_profile_id'] ?? null;
            if (empty($shippingProfileId)) {
                return ToolResult::error('Shipping profile ID is required.');
            }

            $data = [
                'title' => $title,
                'description' => $description,
                'price' => (float) $price,
                'quantity' => (int) $quantity,
                'shipping_profile_id' => (int) $shippingProfileId,
            ];

            // Optional fields
            if (isset($args['taxonomy_id'])) {
                $data['taxonomy_id'] = (int) $args['taxonomy_id'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['who_made'])) {
                $data['who_made'] = $args['who_made'];
            }
            if (isset($args['when_made'])) {
                $data['when_made'] = $args['when_made'];
            }
            if (isset($args['is_supply'])) {
                $data['is_supply'] = (bool) $args['is_supply'];
            }

            $result = $this->service->createListing($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
