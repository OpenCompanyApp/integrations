<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Unbounce sub-account by ID.
 */
class UnbounceGetSubAccount extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_sub_account'; }

    public function description(): string { return 'Get one Unbounce sub-account by ID.'; }

    public function parameters(): array { return ['sub_account_id' => ['type' => 'string', 'required' => true, 'description' => 'Sub-account ID.']]; }

    /**
     * Get a sub-account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSubAccount($this->requiredString($args, 'sub_account_id')));
    }
}
