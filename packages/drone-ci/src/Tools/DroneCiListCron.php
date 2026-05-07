<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** List Drone repository cron jobs. */
class DroneCiListCron extends AbstractDroneCiTool { protected const NAME = 'drone_ci_list_cron'; protected const DESCRIPTION = 'List cron jobs configured for a Drone repository.'; protected const METHOD = 'listCron'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
