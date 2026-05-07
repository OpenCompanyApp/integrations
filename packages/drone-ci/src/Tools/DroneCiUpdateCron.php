<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Update a Drone repository cron job. */
class DroneCiUpdateCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_update_cron'; protected const DESCRIPTION = 'Update one Drone repository cron job.'; protected const METHOD = 'updateCron'; protected const REQUIRED = ['owner', 'repo', 'name', 'payload']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Cron job name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Cron update payload.']]; }
