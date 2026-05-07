<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Update a Manychat subscriber.
 */
class ManyChatUpdateSubscriber extends AbstractManyChatTool
{
    public const NAME = 'manychat_update_subscriber';
    public const DESCRIPTION = 'Update a subscriber by subscriber ID.';
    public const PARAMETERS = [
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Subscriber update payload including subscriber_id.'],
    ];

    /**
     * Update the subscriber.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateSubscriber($this->requiredArray($args, 'data'));
    }
}
