<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_create_voice
 *
 * Creates a new cloned voice in ElevenLabs by providing a name,
 * optional audio samples, and a description.
 */
class ElevenLabsCreateVoice implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_create_voice';
    }

    public function description(): string
    {
        return 'Create a new voice clone in ElevenLabs. Provide a name, optional audio sample file paths or base64-encoded data, and an optional description.';
    }

    /**
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name'        => ['type' => 'string', 'required' => true, 'description' => 'Name for the new voice.'],
            'files'       => ['type' => 'array', 'description' => 'Array of audio sample file paths or base64-encoded audio strings for voice cloning.'],
            'description' => ['type' => 'string', 'description' => 'Optional description of the voice (e.g., "Warm female narrator").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $name        = $args['name'];
            $files       = $args['files'] ?? [];
            $description = $args['description'] ?? '';

            $result = $this->service->createVoice($name, $files, $description);

            return ToolResult::success([
                'voice'   => $result,
                'message' => "Voice '{$name}' created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
