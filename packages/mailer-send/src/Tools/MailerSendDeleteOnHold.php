<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** Delete on-hold suppression entries. */
class MailerSendDeleteOnHold extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_delete_on_hold';
    protected string $toolDescription = 'Delete selected or all on-hold suppression entries.';
    protected string $method = 'DELETE';
    protected string $path = '/suppressions/on-hold-list';
    protected array $bodyParams = ['ids', 'all'];
    protected array $parameters = [
        'ids' => ['type' => 'array', 'description' => 'Suppression entry IDs to delete.', 'items' => ['type' => 'string']],
        'all' => ['type' => 'boolean', 'description' => 'Delete all entries when true.'],
    ];
}
