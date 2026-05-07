<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Generate an image with FLUX.1 [schnell] FP8.
 */
class FireworksAiGenerateANewImageFromATextPrompt extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_generate_a_new_image_from_a_text_prompt';
    protected const DESCRIPTION = 'Generate an image with FLUX.1 [schnell] FP8.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/workflows/accounts/fireworks/models/flux-1-schnell-fp8/text_to_image';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
