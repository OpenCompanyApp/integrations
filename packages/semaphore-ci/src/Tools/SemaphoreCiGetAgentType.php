<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore self-hosted agent type.
 */
class SemaphoreCiGetAgentType extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_agent_type';
    protected const DESCRIPTION = 'Get one Semaphore self-hosted agent type by name.';
    protected const METHOD = 'getAgentType';
    protected const REQUIRED = ['agent_type_name'];
    protected const PARAMETERS = ['agent_type_name' => ['type' => 'string', 'required' => true, 'description' => 'Agent type name.']];
}
