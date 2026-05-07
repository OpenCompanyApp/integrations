<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a restricted Algolia API key.
 */
class AlgoliaAddApiKey extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_add_api_key'; }
    public function description(): string { return 'Add a restricted Algolia API key with ACLs and optional restrictions.'; }
    public function parameters(): array { return ['payload' => ['type' => 'object', 'required' => true, 'description' => 'API key payload including acl and optional restrictions.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->addApiKey($this->objectArg($args, 'payload'))); }
}
