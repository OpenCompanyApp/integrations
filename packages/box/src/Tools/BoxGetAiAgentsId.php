<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get AI agent by agent ID.
 *
 * Executes the official Box API operation get_ai_agents_id.
 */
class BoxGetAiAgentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_ai_agents_id';
}
