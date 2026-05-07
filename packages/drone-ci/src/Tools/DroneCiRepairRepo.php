<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Repair Drone repository webhooks. */
class DroneCiRepairRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_repair_repo'; protected const DESCRIPTION = 'Repair Drone repository webhooks.'; protected const METHOD = 'repairRepo'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
