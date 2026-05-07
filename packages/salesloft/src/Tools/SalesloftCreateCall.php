<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Salesloft call activity.
 */
class SalesloftCreateCall extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_create_call';
    }

    public function description(): string
    {
        return 'Create a Salesloft call activity using an official call payload.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Call activity payload.'],
        ];
    }

    /**
     * Create a call.
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

            return ToolResult::success($this->service->createCall($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
