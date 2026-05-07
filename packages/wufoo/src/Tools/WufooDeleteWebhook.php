<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Delete a webhook integration from a Wufoo form.
 */
class WufooDeleteWebhook extends AbstractWufooTool
{
    public const NAME = 'wufoo_delete_webhook';
    public const DESCRIPTION = 'Delete a webhook from a Wufoo form by webhook hash identifier.';
    public const PARAMETERS = [
        'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The webhook hash identifier.'],
    ];

    /**
     * Delete a form webhook.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteWebhook(
            $this->requiredString($args, 'form_id', 'form_id'),
            $this->requiredString($args, 'webhook_id', 'webhook_id'),
        );
    }
}
