<?php

namespace OpenCompany\Integrations\Beamer\Tools;

/**
 * Call any Beamer POST API endpoint.
 */
class BeamerApiPost extends AbstractBeamerTool
{
    public function name(): string { return 'beamer_api_post'; }
    public function description(): string { return 'Call any Beamer POST API endpoint relative to the configured base URL.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /posts/{id}/comments.'], 'body' => ['type' => 'object', 'description' => 'JSON body.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiPost($this->path($args), is_array($args['body'] ?? null) ? $args['body'] : []); }
}
