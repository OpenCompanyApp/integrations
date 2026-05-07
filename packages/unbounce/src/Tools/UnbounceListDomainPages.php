<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pages published on an Unbounce domain.
 */
class UnbounceListDomainPages extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_domain_pages'; }

    public function description(): string { return 'List pages published on an Unbounce domain.'; }

    public function parameters(): array { return ['domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * List domain pages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listDomainPages($this->requiredString($args, 'domain_id'), $this->arrayArg($args, 'params')));
    }
}
