<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List Elastic Email suppressions by type.
 */
class ElasticEmailListSuppressions extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_suppressions';
    }

    public function description(): string
    {
        return 'List unsubscribes, bounces, or complaints from Elastic Email suppressions.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'unsubscribes, bounces, or complaints. Default: unsubscribes.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listSuppressions((string) ($args['type'] ?? 'unsubscribes'));
    }
}
