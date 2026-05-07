<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pages for a specific Unbounce sub-account.
 */
class UnbounceListSubAccountPages extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_sub_account_pages'; }

    public function description(): string { return 'List landing pages for a specific Unbounce sub-account.'; }

    public function parameters(): array { return ['sub_account_id' => ['type' => 'string', 'required' => true, 'description' => 'Sub-account ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List sub-account pages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSubAccountPages($this->requiredString($args, 'sub_account_id'), $this->arrayArg($args, 'params')));
    }
}
