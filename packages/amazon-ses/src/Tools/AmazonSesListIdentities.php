<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * List Amazon SES verified identities.
 */
class AmazonSesListIdentities extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_list_identities'; }

    public function description(): string { return 'List Amazon SES verified email and domain identities.'; }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Maximum identities to return.'],
            'next_token' => ['type' => 'string', 'description' => 'Pagination token.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listIdentities(isset($args['page_size']) ? (int) $args['page_size'] : null, $args['next_token'] ?? null);
    }
}
