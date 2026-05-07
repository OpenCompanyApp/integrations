<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a person to a Salesloft cadence.
 */
class SalesloftCreateCadenceMembership extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_create_cadence_membership';
    }

    public function description(): string
    {
        return 'Create a Salesloft cadence membership using an official payload.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Cadence membership payload.'],
        ];
    }

    /**
     * Create a cadence membership.
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

            return ToolResult::success($this->service->createCadenceMembership($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
