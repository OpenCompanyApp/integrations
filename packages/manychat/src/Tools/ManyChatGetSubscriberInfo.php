<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Get Manychat subscriber information.
 */
class ManyChatGetSubscriberInfo extends AbstractManyChatTool
{
    public const NAME = 'manychat_get_subscriber_info';
    public const DESCRIPTION = 'Get subscriber information by subscriber ID.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
    ];

    /**
     * Get subscriber info.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getSubscriberInfo($this->requiredInt($args, 'subscriber_id'));
    }
}
