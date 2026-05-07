<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Call any signed Amazon SES DELETE endpoint.
 */
class AmazonSesApiDelete extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_api_delete'; }
    public function description(): string { return 'Call any signed Amazon SES v2 DELETE endpoint.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'SES API path beginning with /v2/.'], 'body' => ['type' => 'object', 'description' => 'JSON body.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiDelete($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []); }
}
