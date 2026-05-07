<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get generated image from FLUX.1 Kontext.
 */
class FireworksAiGetGeneratedImageFromFluxKontex extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_generated_image_from_flux_kontex';
    protected const DESCRIPTION = 'Get generated image from FLUX.1 Kontext.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/workflows/accounts/fireworks/models/{model}/get_result';
    protected const PATH_PARAMS = ['model'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['model' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
