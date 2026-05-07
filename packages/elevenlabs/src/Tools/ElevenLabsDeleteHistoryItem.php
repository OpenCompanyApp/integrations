<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Delete one generation history item.
 */
class ElevenLabsDeleteHistoryItem extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_delete_history_item';
    public const DESCRIPTION = 'Delete one ElevenLabs history item by ID.';
    public const PARAMETERS = [
        'history_item_id' => ['type' => 'string', 'required' => true, 'description' => 'History item ID.'],
    ];

    /**
     * Delete one history item.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteHistoryItem($this->requiredString($args, 'history_item_id', 'history_item_id'));
    }
}
