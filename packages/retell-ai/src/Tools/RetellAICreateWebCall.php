<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Create a Retell AI web call.
 */
class RetellAICreateWebCall extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_create_web_call';
    public const DESCRIPTION = 'Create a Retell AI web call.';
    public const PARAMETERS = [
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Web call payload.'],
    ];

    /**
     * Create the web call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createWebCall($this->requiredArray($args, 'data'));
    }
}
