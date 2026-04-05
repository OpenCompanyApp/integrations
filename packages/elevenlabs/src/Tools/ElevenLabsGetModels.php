<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_get_models
 *
 * Lists all available text-to-speech models from ElevenLabs,
 * including model IDs, names, and supported languages.
 */
class ElevenLabsGetModels implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_models';
    }

    public function description(): string
    {
        return 'List all available ElevenLabs text-to-speech models, including their IDs, names, and language support. Use model IDs when calling text_to_speech.';
    }

    /**
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $result = $this->service->getModels();

            $models = is_array($result) ? $result : [];

            $summary = array_map(function (array $model): array {
                return [
                    'model_id'   => $model['model_id'] ?? '',
                    'name'       => $model['name'] ?? '',
                    'can_be_finetuned' => $model['can_be_finetuned'] ?? false,
                    'can_do_text_to_speech' => $model['can_do_text_to_speech'] ?? false,
                    'can_do_voice_conversion' => $model['can_do_voice_conversion'] ?? false,
                    'can_use_style' => $model['can_use_style'] ?? false,
                    'languages'  => $model['languages'] ?? [],
                ];
            }, $models);

            return ToolResult::success([
                'models'    => $summary,
                'modelCount' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
