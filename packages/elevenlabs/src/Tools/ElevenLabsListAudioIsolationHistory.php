<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * List audio isolation history.
 */
class ElevenLabsListAudioIsolationHistory extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_list_audio_isolation_history';
    public const DESCRIPTION = 'List ElevenLabs audio isolation generations.';
    public const PARAMETERS = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of items to return.'],
        'page' => ['type' => 'integer', 'description' => 'Page number when searching.'],
        'search' => ['type' => 'string', 'description' => 'Optional search term.'],
    ];

    /**
     * List audio isolation history.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listAudioIsolationHistory(array_filter([
            'page_size' => isset($args['page_size']) ? (int) $args['page_size'] : null,
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'search' => $args['search'] ?? null,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }
}
