<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * List Amazon SES configuration sets.
 */
class AmazonSesListConfigurationSets extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_list_configuration_sets'; }

    public function description(): string { return 'List Amazon SES configuration sets.'; }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Maximum configuration sets to return.'],
            'next_token' => ['type' => 'string', 'description' => 'Pagination token.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listConfigurationSets(isset($args['page_size']) ? (int) $args['page_size'] : null, $args['next_token'] ?? null);
    }
}
