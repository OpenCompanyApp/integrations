<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Add a webhook integration to a Wufoo form.
 */
class WufooAddWebhook extends AbstractWufooTool
{
    public const NAME = 'wufoo_add_webhook';
    public const DESCRIPTION = 'Add a webhook to a Wufoo form. Wufoo limits integrations per form, so reuse existing webhooks where possible.';
    public const PARAMETERS = [
        'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
        'url' => ['type' => 'string', 'required' => true, 'description' => 'The HTTPS endpoint Wufoo should call.'],
        'handshake_key' => ['type' => 'string', 'description' => 'Optional shared secret sent with webhook payloads.'],
        'metadata' => ['type' => 'boolean', 'description' => 'Whether Wufoo should include form and field metadata. Default: false.'],
    ];

    /**
     * Add a form webhook.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->addWebhook(
            $this->requiredString($args, 'form_id', 'form_id'),
            $this->requiredString($args, 'url', 'url'),
            isset($args['handshake_key']) ? (string) $args['handshake_key'] : null,
            $this->boolArg($args, 'metadata'),
        );
    }
}
