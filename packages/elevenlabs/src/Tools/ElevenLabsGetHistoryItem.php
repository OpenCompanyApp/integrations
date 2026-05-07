<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Get one generation history item.
 */
class ElevenLabsGetHistoryItem extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_history_item';
    public const DESCRIPTION = 'Get one ElevenLabs history item by ID.';
    public const PARAMETERS = [
        'history_item_id' => ['type' => 'string', 'required' => true, 'description' => 'History item ID.'],
    ];

    /**
     * Get one history item.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getHistoryItem($this->requiredString($args, 'history_item_id', 'history_item_id'));
    }
}
