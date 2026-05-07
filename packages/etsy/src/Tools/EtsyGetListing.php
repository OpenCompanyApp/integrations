<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Etsy\EtsyService;

/**
 * Get details for a specific Etsy listing by ID.
 */
class EtsyGetListing implements Tool
{
    /**
     * @param  EtsyService  $service  The Etsy Open API client.
     */
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_get_listing';
    }

    public function description(): string
    {
        return 'Get full details for a specific Etsy listing, including title, description, price, images, and state.';
    }

    public function parameters(): array
    {
        return [
            'listing_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Etsy listing ID.',
            ],
        ];
    }

    /**
     * Get one listing by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $listingId = $args['listing_id'] ?? null;
            if (empty($listingId)) {
                return ToolResult::error('Listing ID is required.');
            }

            $result = $this->service->getListing((int) $listingId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
