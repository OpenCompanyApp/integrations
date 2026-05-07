<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Unbounce page group by ID.
 */
class UnbounceGetPageGroup extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_page_group'; }

    public function description(): string { return 'Get one Unbounce page group by ID.'; }

    public function parameters(): array { return ['page_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Page group ID.']]; }

    /**
     * Get a page group.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getPageGroup($this->requiredString($args, 'page_group_id')));
    }
}
