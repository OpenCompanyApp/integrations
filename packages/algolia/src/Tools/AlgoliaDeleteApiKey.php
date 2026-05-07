<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an Algolia API key.
 */
class AlgoliaDeleteApiKey extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_delete_api_key'; }
    public function description(): string { return 'Delete an Algolia API key.'; }
    public function parameters(): array { return ['key' => ['type' => 'string', 'required' => true, 'description' => 'The API key value.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteApiKey($this->requiredString($args, 'key'))); }
}
