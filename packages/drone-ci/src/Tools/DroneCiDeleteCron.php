<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Delete a Drone repository cron job. */
class DroneCiDeleteCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_delete_cron'; protected const DESCRIPTION = 'Delete one Drone repository cron job.'; protected const METHOD = 'deleteCron'; protected const REQUIRED = ['owner', 'repo', 'name']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Cron job name.']]; }
