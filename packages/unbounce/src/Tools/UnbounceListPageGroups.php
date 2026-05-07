<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List page groups for an Unbounce sub-account.
 */
class UnbounceListPageGroups extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_page_groups'; }

    public function description(): string { return 'List page groups for an Unbounce sub-account.'; }

    public function parameters(): array { return ['sub_account_id' => ['type' => 'string', 'required' => true, 'description' => 'Sub-account ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List page groups.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listPageGroups($this->requiredString($args, 'sub_account_id'), $this->arrayArg($args, 'params')));
    }
}
