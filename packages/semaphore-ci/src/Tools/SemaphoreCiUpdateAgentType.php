<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Update a Semaphore self-hosted agent type.
 */
class SemaphoreCiUpdateAgentType extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_update_agent_type';
    protected const DESCRIPTION = 'Update a Semaphore self-hosted agent type.';
    protected const METHOD = 'updateAgentType';
    protected const REQUIRED = ['agent_type_name', 'payload'];
    protected const PARAMETERS = ['agent_type_name' => ['type' => 'string', 'required' => true, 'description' => 'Agent type name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Agent type payload.']];
}
