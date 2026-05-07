<?php

namespace OpenCompany\Integrations\Beamer\Tools;

/**
 * Call any Beamer GET API endpoint.
 */
class BeamerApiGet extends AbstractBeamerTool
{
    public function name(): string { return 'beamer_api_get'; }
    public function description(): string { return 'Call any Beamer GET API endpoint relative to the configured base URL.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /posts or /unread/count.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiGet($this->path($args), is_array($args['params'] ?? null) ? $args['params'] : []); }
}
