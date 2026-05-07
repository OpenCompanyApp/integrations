<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Send a Manychat flow to a subscriber.
 */
class ManyChatSendFlow extends AbstractManyChatTool
{
    public const NAME = 'manychat_send_flow';
    public const DESCRIPTION = 'Send an existing Manychat flow to a subscriber.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
        'flow_ns' => ['type' => 'string', 'required' => true, 'description' => 'Flow namespace from the Manychat automation URL or getFlows response.'],
    ];

    /**
     * Send the flow.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->sendFlow(
            $this->requiredInt($args, 'subscriber_id'),
            $this->requiredString($args, 'flow_ns')
        );
    }
}
