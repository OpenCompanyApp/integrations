<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List events for an Elastic Email transaction.
 */
class ElasticEmailListEmailEvents extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_email_events';
    }

    public function description(): string
    {
        return 'List events for a single Elastic Email transaction ID.';
    }

    public function parameters(): array
    {
        return [
            'transaction_id' => ['type' => 'string', 'required' => true, 'description' => 'Transaction ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listEmailEvents($this->stringArg($args, 'transaction_id'));
    }
}
