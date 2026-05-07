<?php

namespace OpenCompany\Integrations\Beamer\Tools;

/**
 * Call any Beamer PUT API endpoint.
 */
class BeamerApiPut extends AbstractBeamerTool
{
    public function name(): string { return 'beamer_api_put'; }
    public function description(): string { return 'Call any Beamer PUT API endpoint relative to the configured base URL.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'API path.'], 'body' => ['type' => 'object', 'description' => 'JSON body.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiPut($this->path($args), is_array($args['body'] ?? null) ? $args['body'] : []); }
}
