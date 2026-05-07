<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a specific Mistral agent version.
 */
class MistralGetAgentVersion extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_agent_version';
    protected const DESCRIPTION = 'Get a specific Mistral agent version.';
    protected const PATH = '/v1/agents/{agent_id}/versions/{version}';
    protected const PATH_PARAMS = ['agent_id', 'version'];
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'version' => ['type' => 'string', 'required' => true, 'description' => 'Agent version identifier.']];
}
