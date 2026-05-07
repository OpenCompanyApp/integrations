<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Delete a Semaphore self-hosted agent type.
 */
class SemaphoreCiDeleteAgentType extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_delete_agent_type';
    protected const DESCRIPTION = 'Delete one Semaphore self-hosted agent type.';
    protected const METHOD = 'deleteAgentType';
    protected const REQUIRED = ['agent_type_name'];
    protected const PARAMETERS = ['agent_type_name' => ['type' => 'string', 'required' => true, 'description' => 'Agent type name.']];
}
