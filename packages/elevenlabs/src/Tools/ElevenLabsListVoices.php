<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_list_voices
 *
 * Lists all available voices in the authenticated ElevenLabs account,
 * including both pre-made and cloned voices.
 */
class ElevenLabsListVoices implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_list_voices';
    }

    public function description(): string
    {
        return 'List all available voices in your ElevenLabs account, including pre-made and cloned voices. Use this to discover voice IDs for text-to-speech.';
    }

    /**
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * List ElevenLabs voices.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $result = $this->service->listVoices();

            $voices = $result['voices'] ?? $result;

            $summary = array_map(function (array $voice): array {
                return [
                    'voice_id'   => $voice['voice_id'] ?? '',
                    'name'       => $voice['name'] ?? '',
                    'category'   => $voice['category'] ?? '',
                    'labels'     => $voice['labels'] ?? [],
                    'preview_url' => $voice['preview_url'] ?? null,
                ];
            }, is_array($voices) ? $voices : []);

            return ToolResult::success([
                'voices'     => $summary,
                'voiceCount' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
