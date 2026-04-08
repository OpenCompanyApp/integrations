<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlutterwaveVerifyTransaction implements Tool
{
    /**
     * Create a new FlutterwaveVerifyTransaction tool instance.
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
        return 'flutterwave_verify_transaction';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Verify a Flutterwave transaction by its ID to confirm payment status and retrieve full details.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'description' => 'The Flutterwave transaction ID to verify.', 'required' => true],
        ];
    }

    /**
     * Execute the tool: verify a transaction on Flutterwave.
     *
     * @param  array  $args  The tool arguments (id required).
     * @return ToolResult The result containing the verification response or an error message.
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

            $result = $this->service->verifyTransaction($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
