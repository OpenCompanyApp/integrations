<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update the active version of a Mistral agent.
 */
class MistralUpdateAgentVersion extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_agent_version';
    protected const DESCRIPTION = 'Patch a Mistral agent version pointer.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/agents/{agent_id}/version';
    protected const PATH_PARAMS = ['agent_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Version update body matching the Mistral API schema.']];
}
