<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get a Drone repository cron job. */
class DroneCiGetCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_cron'; protected const DESCRIPTION = 'Get one Drone repository cron job by name.'; protected const METHOD = 'getCron'; protected const REQUIRED = ['owner', 'repo', 'name']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Cron job name.']]; }
