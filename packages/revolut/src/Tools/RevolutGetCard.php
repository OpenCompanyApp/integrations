<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Revolut card by ID.
 *
 * Returns full card details including status, limits, and cardholder information.
 */
class RevolutGetCard implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_card';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Revolut card by ID.
        Returns full card details including status, limits, and cardholder information.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Revolut card ID.'],
        ];
    }

    /**
     * Retrieve a Revolut card by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $card = $this->service->getCard($id);

            return ToolResult::success([
                'id' => $card['id'] ?? '',
                'last_four_digits' => $card['last_four_digits'] ?? '',
                'status' => $card['status'] ?? '',
                'cardholder_name' => $card['cardholder_name'] ?? '',
                'currency' => $card['currency'] ?? '',
                'type' => $card['type'] ?? '',
                'label' => $card['label'] ?? null,
                'expiry_date' => $card['expiry_date'] ?? null,
                'pin_attempts_remaining' => $card['pin_attempts_remaining'] ?? null,
                'design' => $card['design'] ?? null,
                'spending_limits' => $card['spending_limits'] ?? [],
                'created_at' => $card['created_at'] ?? null,
                'updated_at' => $card['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
