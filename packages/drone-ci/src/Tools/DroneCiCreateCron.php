<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Create a Drone repository cron job. */
class DroneCiCreateCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_create_cron'; protected const DESCRIPTION = 'Create a cron job for a Drone repository.'; protected const METHOD = 'createCron'; protected const REQUIRED = ['owner', 'repo', 'payload']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Cron payload such as name, branch, expr, and disabled.']]; }
