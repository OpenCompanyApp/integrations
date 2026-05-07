<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Unbounce domain by ID.
 */
class UnbounceGetDomain extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_domain'; }

    public function description(): string { return 'Get one Unbounce domain by ID.'; }

    public function parameters(): array { return ['domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Domain ID.']]; }

    /**
     * Get a domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getDomain($this->requiredString($args, 'domain_id')));
    }
}
