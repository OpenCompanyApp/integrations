<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Unbounce accounts available to the token.
 */
class UnbounceListAccounts extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_accounts'; }

    public function description(): string { return 'List Unbounce accounts available to the authenticated token.'; }

    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Query parameters such as sort_order.']]; }

    /**
     * List accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listAccounts($this->arrayArg($args, 'params')));
    }
}
