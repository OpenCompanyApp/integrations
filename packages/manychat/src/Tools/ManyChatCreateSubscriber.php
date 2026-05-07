<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Create a Manychat subscriber.
 */
class ManyChatCreateSubscriber extends AbstractManyChatTool
{
    public const NAME = 'manychat_create_subscriber';
    public const DESCRIPTION = 'Create a subscriber with email, phone, WhatsApp phone, opt-in, and profile fields.';
    public const PARAMETERS = [
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Subscriber creation payload.'],
    ];

    /**
     * Create the subscriber.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createSubscriber($this->requiredArray($args, 'data'));
    }
}
