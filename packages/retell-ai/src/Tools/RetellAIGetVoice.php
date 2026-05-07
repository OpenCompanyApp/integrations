<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Get a Retell AI voice.
 */
class RetellAIGetVoice extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_get_voice';
    public const DESCRIPTION = 'Get a voice by ID.';
    public const PARAMETERS = [
        'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Voice ID.'],
    ];

    /**
     * Get the voice.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getVoice($this->requiredString($args, 'voice_id'));
    }
}
