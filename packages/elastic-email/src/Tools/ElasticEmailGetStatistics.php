<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Get Elastic Email account statistics.
 */
class ElasticEmailGetStatistics extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_statistics';
    }

    public function description(): string
    {
        return 'Get account-wide Elastic Email statistics.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional from and to dates.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getStatistics($this->params($args));
    }
}
