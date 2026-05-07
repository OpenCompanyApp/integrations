<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Disable agents for a Semaphore agent type.
 */
class SemaphoreCiDisableAgentTypeAgents extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_disable_agent_type_agents';
    protected const DESCRIPTION = 'Disable all or only idle agents for a Semaphore self-hosted agent type.';
    protected const METHOD = 'disableAgentTypeAgents';
    protected const REQUIRED = ['agent_type_name'];
    protected const PARAMETERS = ['agent_type_name' => ['type' => 'string', 'required' => true, 'description' => 'Agent type name.'], 'only_idle' => ['type' => 'boolean', 'description' => 'Disable only idle agents. Defaults to true upstream.']];
}
