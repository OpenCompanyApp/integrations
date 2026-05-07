<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Generate an image guided by an input image structure.
 */
class StabilityControlStructure extends AbstractStabilityTool
{
    protected const NAME = 'stability_control_structure';
    protected const DESCRIPTION = 'Generate an image guided by the structure of an input image.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path used as structure guidance.'],
        'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Text prompt for the generated image.'],
        'control_strength' => ['type' => 'number', 'description' => 'How strongly the input structure should guide the output.'],
        'negative_prompt' => ['type' => 'string', 'description' => 'Things to avoid.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/control/structure',
        'file_params' => ['image'],
        'body_params' => ['prompt', 'control_strength', 'negative_prompt', 'seed', 'output_format'],
        'required' => ['image', 'prompt'],
        'accept' => 'image/*',
    ];
}
