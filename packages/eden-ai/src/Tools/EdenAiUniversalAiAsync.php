<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Submit an Eden AI V3 Universal AI async job.
 */
class EdenAiUniversalAiAsync extends EdenAiUniversalAi
{
    public const NAME = 'edenai_universal_ai_async';
    public const DESCRIPTION = 'Submit an Eden AI V3 Universal AI async expert-model job.';
    public const PARAMETERS = [
        'model' => ['type' => 'string', 'required' => true, 'description' => 'Model string such as ocr/ocr_async/amazon.'],
        'input' => ['type' => 'object', 'required' => true, 'description' => 'Feature-specific input object.'],
        'fallbacks' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Fallback model IDs.'],
        'provider_params' => ['type' => 'object', 'description' => 'Provider-specific parameters.'],
        'show_original_response' => ['type' => 'boolean', 'description' => 'Whether to include the raw provider response.'],
        'webhook_receiver' => ['type' => 'string', 'description' => 'Optional webhook receiver URL for async completion.'],
    ];

    /**
     * Submit a Universal AI async job.
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

        foreach (['fallbacks', 'provider_params', 'show_original_response', 'webhook_receiver'] as $key) {
            if (array_key_exists($key, $args)) {
                $body[$key] = $args[$key];
            }
        }

        return $this->service->universalAiAsync($body);
    }
}
