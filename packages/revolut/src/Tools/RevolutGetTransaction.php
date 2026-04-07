<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Revolut transaction by ID.
 *
 * Returns full transaction details including amount, currency, legs, and state.
 */
class RevolutGetTransaction implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_transaction';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Revolut transaction by ID.
        Returns full transaction details including amount, currency, legs, and state.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Revolut transaction ID.'],
        ];
    }

    /**
     * Retrieve a Revolut transaction by ID with full details.
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

            $transaction = $this->service->getTransaction($id);

            return ToolResult::success([
                'id' => $transaction['id'] ?? '',
                'type' => $transaction['type'] ?? '',
                'state' => $transaction['state'] ?? '',
                'legs' => $transaction['legs'] ?? [],
                'description' => $transaction['description'] ?? '',
                'reference' => $transaction['reference'] ?? null,
                'created_at' => $transaction['created_at'] ?? null,
                'updated_at' => $transaction['updated_at'] ?? null,
                'completed_at' => $transaction['completed_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
