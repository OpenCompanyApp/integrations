<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Send content to a Manychat subscriber.
 */
class ManyChatSendContent extends AbstractManyChatTool
{
    public const NAME = 'manychat_send_content';
    public const DESCRIPTION = 'Send content to a subscriber through /fb/sending/sendContent.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Manychat content payload.'],
        'message_tag' => ['type' => 'string', 'description' => 'Optional message tag such as ACCOUNT_UPDATE.'],
        'otn_topic_name' => ['type' => 'string', 'description' => 'Optional one-time notification topic name.'],
    ];

    /**
     * Send content.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $payload = [
            'subscriber_id' => $this->requiredInt($args, 'subscriber_id'),
            'data' => $this->requiredArray($args, 'data'),
        ];

        foreach (['message_tag', 'otn_topic_name'] as $key) {
            if (isset($args[$key]) && $args[$key] !== '') {
                $payload[$key] = (string) $args[$key];
            }
        }

        return $this->service->sendContent($payload);
    }
}
