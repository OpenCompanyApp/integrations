<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Venmo payment by ID.
 *
 * Returns full payment details including amount, status, note, sender, and recipient.
 */
class VenmoGetPayment implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_get_payment';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Venmo payment by ID.
        Returns full payment details including amount, status, note, sender, and recipient.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Venmo payment ID.'],
        ];
    }

    /**
     * Retrieve a Venmo payment by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getPayment($id);
            $payment = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $payment['id'] ?? '',
                'status' => $payment['status'] ?? '',
                'amount' => $payment['amount'] ?? 0,
                'note' => $payment['note'] ?? '',
                'action' => $payment['action'] ?? '',
                'sender' => $payment['sender'] ?? null,
                'recipient' => $payment['recipient'] ?? null,
                'created_at' => $payment['created_at'] ?? null,
                'updated_at' => $payment['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
