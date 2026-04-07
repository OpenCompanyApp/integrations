<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraGetTransaction implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_get_transaction'; }

    public function description(): string
    {
        return 'Retrieve details of a single transaction in Avalara by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The transaction ID (can be the Avalara transaction ID or the code).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Transaction ID is required.');
            }

            $result = $this->service->getTransaction($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
