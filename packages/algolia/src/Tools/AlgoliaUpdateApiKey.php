<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a restricted Algolia API key.
 */
class AlgoliaUpdateApiKey extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_update_api_key'; }
    public function description(): string { return 'Update ACLs and restrictions for an Algolia API key.'; }
    public function parameters(): array { return ['key' => ['type' => 'string', 'required' => true, 'description' => 'The API key value.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Updated API key payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateApiKey($this->requiredString($args, 'key'), $this->objectArg($args, 'payload'))); }
}
