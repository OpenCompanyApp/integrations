<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Send a bulk Elastic Email payload.
 */
class ElasticEmailSendBulkEmail extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_send_bulk_email';
    }

    public function description(): string
    {
        return 'Send a bulk email using the Elastic Email /emails endpoint with a full v4 payload.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Elastic Email EmailMessageData payload.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->sendBulkEmail($this->params($args, 'payload'));
    }
}
