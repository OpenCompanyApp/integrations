<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore self-hosted agent.
 */
class SemaphoreCiGetAgent extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_agent';
    protected const DESCRIPTION = 'Get one Semaphore self-hosted agent by name.';
    protected const METHOD = 'getAgent';
    protected const REQUIRED = ['agent_name'];
    protected const PARAMETERS = ['agent_name' => ['type' => 'string', 'required' => true, 'description' => 'Agent name.']];
}
