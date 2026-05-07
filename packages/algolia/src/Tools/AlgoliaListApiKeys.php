<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Algolia API keys.
 */
class AlgoliaListApiKeys extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_list_api_keys'; }
    public function description(): string { return 'List Algolia API keys in the application.'; }
    public function parameters(): array { return []; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listApiKeys()); }
}
