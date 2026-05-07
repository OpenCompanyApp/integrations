<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Call any signed Amazon SES POST endpoint.
 */
class AmazonSesApiPost extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_api_post'; }
    public function description(): string { return 'Call any signed Amazon SES v2 POST endpoint.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'SES API path beginning with /v2/.'], 'body' => ['type' => 'object', 'description' => 'JSON body.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiPost($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []); }
}
