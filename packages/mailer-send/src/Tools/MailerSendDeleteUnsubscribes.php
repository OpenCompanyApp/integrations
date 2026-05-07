<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete unsubscribe suppression entries. */
class MailerSendDeleteUnsubscribes extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_unsubscribes';
    protected string $toolDescription = 'Delete selected or all unsubscribe suppression entries.';
    protected string $method = 'DELETE';
    protected string $path = '/suppressions/unsubscribes';
    protected array $bodyParams = ['ids', 'all'];
    protected array $parameters = [
        'ids' => ['type' => 'array', 'description' => 'Suppression entry IDs to delete.', 'items' => ['type' => 'string']],
        'all' => ['type' => 'boolean', 'description' => 'Delete all entries when true.'],
    ];
}
