<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiGetOffer implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_get_offer';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Kajabi offer by its ID. Returns full offer data including title, price, and associated product details.';
    }

    public function parameters(): array
    {
        return [
            'offer_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the offer to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kajabi integration is not configured.');
            }

            if (empty($args['offer_id'])) {
                return ToolResult::error('offer_id is required.');
            }

            $result = $this->service->getOffer($args['offer_id']);

            $offer = $result['offer'] ?? $result['data'] ?? $result;

            return ToolResult::success($offer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
