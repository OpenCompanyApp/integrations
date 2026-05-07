<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Trigger a Drone repository cron job. */
class DroneCiTriggerCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_trigger_cron'; protected const DESCRIPTION = 'Trigger one Drone repository cron job immediately.'; protected const METHOD = 'triggerCron'; protected const REQUIRED = ['owner', 'repo', 'name']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Cron job name.']]; }
