<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Start an EmailOctopus automation for a list contact. */
class EmailOctopusStartAutomation extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_start_automation';
    protected const DESCRIPTION = 'Start an EmailOctopus automation for a list contact. The automation must use the Started via API trigger.';
    protected const METHOD = 'startAutomation';
    protected const PARAMETERS = ['automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Automation ID.'], 'list_member_id' => ['type' => 'string', 'required' => true, 'description' => 'List contact ID.']];
}
