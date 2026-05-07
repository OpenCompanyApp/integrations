<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Generate or edit an image with FLUX.1 Kontext.
 */
class FireworksAiGenerateOrEditImageUsingFluxKontext extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_generate_or_edit_image_using_flux_kontext';
    protected const DESCRIPTION = 'Generate or edit an image with FLUX.1 Kontext.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/workflows/accounts/fireworks/models/{model}';
    protected const PATH_PARAMS = ['model'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['model' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
