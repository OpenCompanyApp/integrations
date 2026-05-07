<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Get the current ElevenLabs subscription.
 */
class ElevenLabsGetSubscription extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_subscription';
    public const DESCRIPTION = 'Get the authenticated ElevenLabs subscription and quota details.';
    public const PARAMETERS = [];

    /**
     * Get subscription.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getSubscription();
    }
}
