<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pages in an Unbounce page group.
 */
class UnbounceListPageGroupPages extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_page_group_pages'; }

    public function description(): string { return 'List pages in an Unbounce page group.'; }

    public function parameters(): array { return ['page_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Page group ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List page group pages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listPageGroupPages($this->requiredString($args, 'page_group_id'), $this->arrayArg($args, 'params')));
    }
}
