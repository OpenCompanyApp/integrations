<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Venmo payment.
 *
 * Supports specifying amount, recipient, note, and audience visibility.
 */
class VenmoCreatePayment implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_create_payment';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Venmo payment.
        Specify amount, recipient user ID, an optional note, and audience visibility.
        MD;
    }

    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'number', 'required' => true, 'description' => 'Payment amount in dollars (e.g., 25.00).'],
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Recipient Venmo user ID.'],
            'note' => ['type' => 'string', 'required' => true, 'description' => 'Payment note or description.'],
            'audience' => ['type' => 'string', 'description' => 'Visibility: "private", "friends", or "public". Default: "friends".'],
        ];
    }

    /**
     * Create a Venmo payment.
     *
     * @param  array<string, mixed>  $args  Tool arguments (amount, user_id, note, audience)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $amount = $args['amount'] ?? null;
            $userId = $args['user_id'] ?? '';
            $note = $args['note'] ?? '';

            if ($amount === null) {
                return ToolResult::error('amount is required.');
            }
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }
            if (empty($note)) {
                return ToolResult::error('note is required.');
            }

            $data = [
                'amount' => (float) $amount,
                'user_id' => $userId,
                'note' => $note,
            ];

            if (isset($args['audience'])) {
                $data['audience'] = $args['audience'];
            }

            $result = $this->service->createPayment($data);
            $payment = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $payment['id'] ?? '',
                'status' => $payment['status'] ?? '',
                'amount' => $payment['amount'] ?? 0,
                'note' => $payment['note'] ?? '',
                'action' => $payment['action'] ?? '',
                'audience' => $payment['audience'] ?? null,
                'created_at' => $payment['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
