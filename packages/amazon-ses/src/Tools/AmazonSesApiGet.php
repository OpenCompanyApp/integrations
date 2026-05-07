<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Call any signed Amazon SES GET endpoint.
 */
class AmazonSesApiGet extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_api_get'; }
    public function description(): string { return 'Call any signed Amazon SES v2 GET endpoint.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'SES API path beginning with /v2/.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array { return $this->service->apiGet($this->stringArg($args, 'path'), is_array($args['params'] ?? null) ? $args['params'] : []); }
}
