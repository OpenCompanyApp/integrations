<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Revolut account by ID.
 *
 * Returns full account details including balance, currency, and state.
 */
class RevolutGetAccount implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Revolut account by ID.
        Returns full account details including balance, currency, and state.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Revolut account ID.'],
        ];
    }

    /**
     * Retrieve a Revolut account by ID with full details.
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

            $account = $this->service->getAccount($id);

            return ToolResult::success([
                'id' => $account['id'] ?? '',
                'name' => $account['name'] ?? '',
                'currency' => $account['currency'] ?? '',
                'balance' => $account['balance'] ?? 0,
                'state' => $account['state'] ?? '',
                'type' => $account['type'] ?? '',
                'public_id' => $account['public_id'] ?? null,
                'created_at' => $account['created_at'] ?? null,
                'updated_at' => $account['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
