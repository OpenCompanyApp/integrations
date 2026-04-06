<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeGetTransaction implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_get_transaction';
    }

    public function description(): string
    {
        return 'Retrieve a single Braintree transaction by its ID. Returns full transaction details including amount, status, payment instrument, and settlement info.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The transaction ID (e.g., "abc123xyz").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Transaction ID is required.');
            }

            $result = $this->service->getTransaction($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
