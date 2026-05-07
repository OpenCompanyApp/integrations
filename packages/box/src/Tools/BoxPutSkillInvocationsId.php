<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update all Box Skill cards on file.
 *
 * Executes the official Box API operation put_skill_invocations_id.
 */
class BoxPutSkillInvocationsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_skill_invocations_id';
}
