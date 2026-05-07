<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Algolia API key.
 */
class AlgoliaGetApiKey extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_get_api_key'; }
    public function description(): string { return 'Get settings and ACLs for one Algolia API key.'; }
    public function parameters(): array { return ['key' => ['type' => 'string', 'required' => true, 'description' => 'The API key value.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getApiKey($this->requiredString($args, 'key'))); }
}
