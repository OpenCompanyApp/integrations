<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Call Eden AI V3 Universal AI synchronously.
 */
class EdenAiUniversalAi extends AbstractEdenAiTool
{
    public const NAME = 'edenai_universal_ai';
    public const DESCRIPTION = 'Call Eden AI V3 Universal AI for synchronous expert-model features.';
    public const PARAMETERS = [
        'model' => ['type' => 'string', 'required' => true, 'description' => 'Model string such as text/moderation/openai or image/generation/google/imagen-3.'],
        'input' => ['type' => 'object', 'required' => true, 'description' => 'Feature-specific input object.'],
        'fallbacks' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Fallback model IDs.'],
        'provider_params' => ['type' => 'object', 'description' => 'Provider-specific parameters.'],
        'show_original_response' => ['type' => 'boolean', 'description' => 'Whether to include the raw provider response.'],
    ];

    /**
     * Call Universal AI.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = [
            'model' => $this->requiredString($args, 'model', 'model'),
            'input' => $this->requiredArray($args, 'input', 'input'),
        ];

        foreach (['fallbacks', 'provider_params', 'show_original_response'] as $key) {
            if (array_key_exists($key, $args)) {
                $body[$key] = $args[$key];
            }
        }

        return $this->service->universalAi($body);
    }
}
