<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Disable a Drone repository. */
class DroneCiDisableRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_disable_repo'; protected const DESCRIPTION = 'Disable a repository in Drone.'; protected const METHOD = 'disableRepo'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
