<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Send a Loops transactional email.
 *
 * Supports data variables, attachments, audience creation, and an optional
 * idempotency key header.
 */
class LoopsSendTransactionalEmail extends AbstractLoopsTool
{
    protected const NAME = 'loops_send_transactional_email';
    protected const DESCRIPTION = 'Send a Loops transactional email by transactionalId to one recipient.';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address.'],
        'transactionalId' => ['type' => 'string', 'required' => true, 'description' => 'The Loops transactional email ID.'],
        'addToAudience' => ['type' => 'boolean', 'description' => 'Whether to add the recipient to the audience if missing.'],
        'dataVariables' => ['type' => 'object', 'description' => 'Template data variables.'],
        'attachments' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Optional attachments with filename, contentType, and base64 data.'],
        'idempotency_key' => ['type' => 'string', 'description' => 'Optional Idempotency-Key header value.'],
    ];

    /**
     * Send the transactional email.
     *
     * @param  array<string, mixed>  $args  Transactional email payload and optional idempotency_key.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $idempotencyKey = $args['idempotency_key'] ?? null;
        unset($args['idempotency_key']);

        return $this->service->sendTransactionalEmail($args, is_string($idempotencyKey) ? $idempotencyKey : null);
    }
}
