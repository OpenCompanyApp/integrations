<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List domains for an Unbounce sub-account.
 */
class UnbounceListDomains extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_domains'; }

    public function description(): string { return 'List domains for an Unbounce sub-account.'; }

    public function parameters(): array { return ['sub_account_id' => ['type' => 'string', 'required' => true, 'description' => 'Sub-account ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List domains.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listDomains($this->requiredString($args, 'sub_account_id'), $this->arrayArg($args, 'params')));
    }
}
