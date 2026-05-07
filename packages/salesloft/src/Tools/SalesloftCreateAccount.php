<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Salesloft account.
 */
class SalesloftCreateAccount extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_create_account';
    }

    public function description(): string
    {
        return 'Create a Salesloft account using an official account payload.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Account creation payload.'],
        ];
    }

    /**
     * Create an account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            $payload = $this->payload($args);
            if ($payload === null) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->createAccount($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
