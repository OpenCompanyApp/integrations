<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlutterwaveGetTransaction implements Tool
{
    /**
     * Create a new FlutterwaveGetTransaction tool instance.
     *
     * @param  FlutterwaveService  $service  The Flutterwave service used to make API calls.
     */
    public function __construct(
        private FlutterwaveService $service,
    ) {}

    /**
     * The unique tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'flutterwave_get_transaction';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Retrieve full details of a specific Flutterwave transaction by its ID.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'description' => 'The Flutterwave transaction ID.', 'required' => true],
        ];
    }

    /**
     * Execute the tool: fetch a single transaction from Flutterwave.
     *
     * @param  array  $args  The tool arguments (id required).
     * @return ToolResult The result containing the transaction details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Flutterwave integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getTransaction($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
