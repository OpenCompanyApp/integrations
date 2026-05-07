<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral agents.
 */
class MistralListAgents extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_agents';
    protected const DESCRIPTION = 'List Mistral agents.';
    protected const PATH = '/v1/agents';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional agent list query parameters.']];
}
