<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Unbounce account by ID.
 */
class UnbounceGetAccount extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_account'; }

    public function description(): string { return 'Get one Unbounce account by ID.'; }

    public function parameters(): array { return ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Unbounce account ID.']]; }

    /**
     * Get an account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getAccount($this->requiredString($args, 'account_id')));
    }
}
