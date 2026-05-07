<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Download audio for one generation history item.
 */
class ElevenLabsGetHistoryItemAudio extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_history_item_audio';
    public const DESCRIPTION = 'Download base64-encoded audio for one ElevenLabs history item.';
    public const PARAMETERS = [
        'history_item_id' => ['type' => 'string', 'required' => true, 'description' => 'History item ID.'],
    ];

    /**
     * Get history item audio.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getHistoryItemAudio($this->requiredString($args, 'history_item_id', 'history_item_id'));
    }
}
