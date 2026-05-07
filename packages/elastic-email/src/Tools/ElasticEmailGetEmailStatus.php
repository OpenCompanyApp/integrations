<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Get delivery status for an Elastic Email transaction.
 */
class ElasticEmailGetEmailStatus extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_email_status';
    }

    public function description(): string
    {
        return 'Get delivery status for an Elastic Email transaction ID.';
    }

    public function parameters(): array
    {
        return [
            'transaction_id' => ['type' => 'string', 'required' => true, 'description' => 'Transaction ID returned by send email.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getEmailStatus($this->stringArg($args, 'transaction_id'));
    }
}
