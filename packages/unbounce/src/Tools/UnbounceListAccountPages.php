<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pages for a specific Unbounce account.
 */
class UnbounceListAccountPages extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_account_pages'; }

    public function description(): string { return 'List landing pages for a specific Unbounce account.'; }

    public function parameters(): array { return ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List account pages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listAccountPages($this->requiredString($args, 'account_id'), $this->arrayArg($args, 'params')));
    }
}
